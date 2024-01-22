<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\GroupController;
use App\Http\Controllers\api\v1\ScaleController;
use App\Http\Controllers\api\v1\MusicController;
use App\Http\Controllers\api\v1\GroupMemberController;
use App\Http\Middleware\v1\ProtectedRouteAuth;


Route::get('/', function () {
    return response()->json(['api_name' => 'banckend-equipe', 'api_version' => 'v1.0.0']);
});

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('user', [UserController::class, 'create']);

    Route::middleware([ProtectedRouteAuth::class])->group(function () {
        Route::post('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);

        Route::post('group', [GroupController::class, 'create']);
        Route::get('group/{id}', [GroupController::class, 'getAll']);
        Route::post('group/add-member/', [GroupMemberController::class, 'create']);

        Route::post('scale', [ScaleController::class, 'create']);
        Route::get('scale/{group_id}/{member_id}', [ScaleController::class, 'getAll']);
        Route::get('scale/get-by-id/teste/{id}', [ScaleController::class, 'getById']);

        Route::post('music', [MusicController::class, 'create']);
    });
});
