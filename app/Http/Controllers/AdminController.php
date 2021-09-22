<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Traits\LinksCRUDTrait;
use App\Traits\SnippetsCRUDTrait;

class AdminController extends Controller
{
    use LinksCRUDTrait, SnippetsCRUDTrait;

    /**
     * AdminController instance secutiry middlewares.
     */
    public function __construct() {
        $this->middleware('api_jwt_auth', [ 'except' => [] ]);
    }

    /**
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function GetResource($resource) {
        $user = auth()->userOrFail();
        $data = [];

        switch ($resource) {
            case 'files':
                $data = $user->files;
                break;

            case 'snippets':
                $data = $user->snippets;
                break;

            case 'links':
                $data = $user->links;
                break;

            default:
                break;
        }

        return response()->json($data, 200);
    }

    public function StoreResource(Request $request, $resource) {
        $validation = $this->validateRequest($request, $resource);
        if($validation['errors']) {
            return response()->json([ 'message' => $validation['message'] ], 400);
        }

        try {
            return DB::transaction(function () use ($request, $resource) {
                $user = auth()->user();
                $responseData = [];

                switch ($resource) {
                    case 'snippets':
                        $responseData = $this->createSnippet($request, $user);
                        break;

                    case 'links':
                        $responseData = $this->createLink($request, $user);
                        break;
                }

                return response()->json($responseData, 200);
            });

        } catch (\Exception $e) {
            return $this->log_exception($e);
        }
    }

    public function UpdateResource(Request $request, $resource, $id) {
        $validation = $this->validateRequest($request, $resource);
        if($validation['errors']) {
            return response()->json([ 'message' => $validation['message'] ], 400);
        }

        try {
            return DB::transaction(function () use ($request, $resource, $id) {
                $user = auth()->user();
                $responseData = [];

                switch ($resource) {
                    case 'snippets':
                        $responseData = $this->updateSnippet($request, $user, $id);
                        break;

                    case 'links':
                        $responseData = $this->updateLink($request, $user, $id);
                        break;
                }

                return response()->json($responseData, 200);
            });

        } catch (\Exception $e) {
            return $this->log_exception($e);
        }
    }

    public function DeleteResource($resource, $id) {
        try {
            return DB::transaction(function () use ($resource, $id) {
                $user = auth()->user();
                $responseData = [];

                switch ($resource) {
                    case 'snippets':
                        $responseData = $this->deleteSnippet($user, $id);
                        break;

                    case 'links':
                        $responseData = $this->deleteLink($user, $id);
                        break;
                }

                return response()->json($responseData, 200);
            });

        } catch (\Exception $e) {
            return $this->log_exception($e);
        }
    }



    private function validateRequest($request, $resource) {
        $validationRules = [];

        switch ($resource) {
            case 'snippets':
                $validationRules = [
                    'title'           => 'required|string|max:125',
                    'description'     => 'required|string|max:500',
                    'html'            => 'required|string',
                    'is_private'      => 'sometimes|boolean|nullable'
                ];
                break;

            case 'links':
                $validationRules = [
                    'title'           => 'required|string|max:125',
                    'url'             => 'required|string|min:8',
                    'open_in_new_tab' => 'sometimes|boolean|nullable',
                    'is_private'      => 'sometimes|boolean|nullable'
                ];
                break;
        }

        $validation = Validator::make($request->all(), $validationRules);
        $response = array();

        if ($validation->fails()) {
            $response['errors'] = true;
            $response['message'] = $validation->messages()->first();
        } else {
            $response['errors'] = false;
        }

        return $response;
    }

}
