<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Material\MaterialCategoryController;
use App\Http\Controllers\Api\V1\Material\MaterialController;
use App\Http\Controllers\Api\V1\Product\BomController;
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



/* Route::middleware('auth:sanctum')
    ->prefix('v1')
    ->group(function () {

        Route::apiResource(
            'product-categories',
            ProductCategoryController::class
        );
        Route::apiResource('products', ProductController::class);
          Route::apiResource(
            'material-categories',
            MaterialCategoryController::class
        );

        Route::apiResource(
            'materials',
            MaterialController::class
        );
         Route::apiResource(
            'boms',
            BomController::class
        );

        // BOM Approval
        Route::patch(
            'boms/{id}/approve',
            [BomController::class, 'approve']
        );

    });
 */


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
    });
});


Route::prefix("v1")->group(function(){
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
