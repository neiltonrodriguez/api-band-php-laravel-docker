<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;


class LoginService
{
    public function execute(array $credentials)
    {
        if (!$token = auth()->setTTL(6 * 60)->attempt($credentials)) {
            throw new \Exception('Unauthorized', 401);
        }

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
            'user' => auth()->user(),
        ];
    }
}
