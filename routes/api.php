<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Material\MaterialCategoryController;
use App\Http\Controllers\Api\V1\Material\MaterialController;
use App\Http\Controllers\Api\V1\Product\BomController;
use App\Http\Controllers\Api\V1\Product\ProductCategoryController;
use App\Http\Controllers\Api\V1\Product\ProductController;
use App\Http\Controllers\Api\V1\Production\ProductionOrderController;

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


Route::prefix("v1")->group(function () {
    Route::middleware([
        'auth:sanctum',
        'role:system_admin,production_manager'
    ])->group(function () {

        Route::apiResource(
            'product-categories',
            ProductCategoryController::class
        );

        Route::apiResource(
            'products',
            ProductController::class
        );

        Route::apiResource(
            'boms',
            BomController::class
        );

        Route::patch(
            'boms/{id}/approve',
            [BomController::class, 'approve']
        );
        Route::apiResource("/production-orders", ProductionOrderController::class);
        Route::patch(
            '/production-orders/{productionOrder}/plan',
            [ProductionOrderController::class, 'plan']
        );
        Route::patch(
            '/production-orders/{productionOrder}/release',
            [ProductionOrderController::class, 'release']
        );
    });
});


Route::prefix("v1")->group(function () {
    Route::middleware([
        'auth:sanctum',
        'role:system_admin,warehouse_manager'
    ])->group(function () {

        Route::apiResource(
            'material-categories',
            MaterialCategoryController::class
        );

        Route::apiResource(
            'materials',
            MaterialController::class
        );
    });
});
