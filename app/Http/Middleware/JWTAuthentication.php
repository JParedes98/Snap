<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Lang;

class JWTAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

        } catch (Exception $e) {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'message' => Lang::get('auth.token_invalid')
                ], 401);
            }

            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'message' => Lang::get('auth.token_expired')
                ], 401);
            }

            return response()->json([
                'message'   => Lang::get('auth.token_not_found')
            ], 401);

        }
        return $next($request);
    }
}
