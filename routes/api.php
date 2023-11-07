<?php

use App\Http\Controllers\API\Admin\CategoryController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Router Authentication
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login'])->name("api.user.login");

Route::middleware('auth:sanctum', 'isAPIAdmin')->group(function () {
    // Router Authentication
    Route::get('/checkingAuthenticated', function ()  {
        return response()->json(['message' => 'You are in ', 'status'=>200], 200);
    });
    // Router Add Categorys
    Route::post('admin/store-category', [CategoryController::class , 'storeCategory']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout',[AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
