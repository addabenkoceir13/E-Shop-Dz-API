<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login'])->name("api.user.login");

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/checkingAuthenticated', function ()  {
        return response()->json(['message' => 'You are in ', 'status'=>200], 200);
    });
    Route::post('logout',[AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
