<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(Request $r)
    {

        try {
            $credentials = $r->only('email', 'password');

            $auth = $this->loginService->execute($credentials);
            return response()->json($auth, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    public function me()
    {

        try {
            return response()->json(auth()->user(), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    public function logout()
    {

        try {
            auth()->logout(true);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }
}
