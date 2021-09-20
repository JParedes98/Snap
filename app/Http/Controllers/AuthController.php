<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('api_jwt_auth', [ 'except' => ['login', 'register'] ]);
    }

    /**
     * Login and response back with JWT via given credentials.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'         => 'required|string|email|max:255',
            'password'      => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'message' => $validator->messages()->first() ], 400);
        }

        try {
            $credentials = request(['email', 'password']);
            $token = auth()->attempt($credentials);

            if (!$token) {
                return response()->json(['message' => Lang::get('auth.failed')], 401);
            }

            return response()->json([
                'access_token'  => $token,
                'token_type'    => 'bearer',
                'expires_in'    => Carbon::now()->addHours(1),
                'user'          => auth()->user()
            ], 200);

        } catch (\Exception $e) {
            return $this->log_exception($e);
        }
    }

    /**
     * Register new User and Get its JWT.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:250',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'error' => $validator->messages()->first() ], 400);
        }

        try {
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password)
            ]);

            return response()->json([
                'message'   => Lang::get('auth.user_registered'),
                'data'      => [
                    'user' => $user,
                ]
            ], 200);

        } catch (\Exception $e) {
            return $this->log_exception($e);
        }
    }

    /**
     *
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        try {
            auth()->logout();
            return response()->json(['message' => Lang::get('auth.user_logout')], 200);

        } catch (\Exception $e) {
            return $this->log_exception($e);
        }
    }
}
