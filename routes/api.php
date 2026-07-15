<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Product\ProductCategoryController;
use App\Http\Controllers\Api\V1\Product\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {

        Route::post('/login', [AuthController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function () {

            Route::get('/profile', [AuthController::class, 'profile']);

            Route::post('/logout', [AuthController::class, 'logout']);
        });
    });
});



Route::middleware('auth:sanctum')
    ->prefix('v1')
    ->group(function () {

        Route::apiResource(
            'product-categories',
            ProductCategoryController::class
        );
        Route::apiResource('products', ProductController::class);

    });
