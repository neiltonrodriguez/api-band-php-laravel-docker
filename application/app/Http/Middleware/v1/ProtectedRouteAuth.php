<?php

namespace App\Http\Middleware\v1;

use Closure;
use Illuminate\Http\Request;
use \Tymon\JWTAuth\Facades\JWTAuth;

class ProtectedRouteAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            // $access_token_header = explode(' ', $request->header('Authorization'))[1];

            // if($user->access_token != $access_token_header){
            //     // auth()->invalidate(true);
            // }
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is invalid'], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Token is expired'], 401);
            } else {
                return response()->json(['status' => 'Authorization token not found'], 401);
            }
        }
        return $next($request);
    }
}
