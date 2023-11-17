<?php

use App\Http\Controllers\API\Admin\CategoryController;
use App\Http\Controllers\API\Admin\ProductsController;
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
    // ----------------------------------- Categories --------------------------------------------------------
    // Router for Add Categories
    Route::post('admin/store-category', [CategoryController::class , 'storeCategories']);
    // Router for View categories
    Route::get('admin/view-category', [CategoryController::class, 'viewCategories']);
    // Route for view ppage edit categor
    Route::get('admin/edit-category/{id}',[CategoryController::class,'editCategories']);
    // Router for update categories
    Route::put('admin/update-category/{id}', [CategoryController::class, 'updateCategories']);
    // Router for deleted categories
    Route::delete('admin/deleted-category/{id}', [CategoryController::class, 'deletedCategories']);
    // Router for all category
    Route::get('admin/all-categories', [CategoryController::class, 'AllCategories']);

    // ----------------------------------- Products -------------------------------------------------------------
    // Router for add products
    Route::post('admin/add-products', [ProductsController::class, 'AddProducts']);
    Route::post('admin/imageupload',[ProductsController::class , 'imageUpload']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout',[AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
