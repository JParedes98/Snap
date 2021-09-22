<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\File;
use App\Models\Link;
use App\Models\Snippet;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    /**
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function GetResource($resource){
        $data = [];

        switch ($resource) {
            case 'files':
                $data = $this->getAllFiles();
                break;

            case 'snippets':
                $data = $this->getAllSnippets();
                break;

            case 'links':
                $data = $this->getAllLinks();
                break;

            default:
                break;
        }

        return response()->json($data, 200);
    }



    public function DownloadFIle(Request $request) {
        $validator = Validator::make($request->all(), [
            'token'        => 'sometimes|string|nullable',
            'fileId'       => 'required|integer',
            'fileName'     => 'required|string',
        ]);

        if ($validator->fails()) { return response()->json([ 'error' => $validator->messages()->first() ], 400); }

        $file = File::where('id', $request->fileId)->firstOrFail();

        if(Storage::has($request->fileName)) {
            if(!$file->is_private) {
                return Storage::download($request->fileName, $file->title . '.pdf');
            }

            $user = JWTAuth::parseToken()->authenticate($request->token);
            if($file->user_id === $user->id) {
                return Storage::download($request->fileName, $file->title . '.pdf');
            }
        } else {
            return response()->json([
                'error' => Lang::get('resource_not_available')
            ], 404);
        }
    }


    /**
     * @return mixed
     */
    private function getAllFiles() {
        return File::where('is_private', false)
                    ->with('owner')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    /**
     * @return mixed
     */
    private function getAllSnippets() {
        return Snippet::where('is_private', false)
                        ->with('owner')
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    /**
     * @return mixed
     */
    private function getAllLinks() {
        return Link::where('is_private', false)
                    ->with('owner')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
