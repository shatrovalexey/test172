<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::prefix('order')->group(function() {
    Route::get('/status/{status}', [OrderController::class, 'getWithStatus',]);
    Route::post('/{id}/status/{status}', [OrderController::class, 'setStatus',]);
    Route::post('/', [OrderController::class, 'add',]);
    Route::post('/{id}', [OrderController::class, 'set',]);
    Route::get('/{id}', [OrderController::class, 'one',]);
    Route::get('/', [OrderController::class, 'list',]);
    Route::post('/del/{id}', [OrderController::class, 'del',]);

    Route::prefix('{order_id}/product/{product_id}')->group(function() {
        Route::post('/del', [OrderController::class, 'productDel',]);
        Route::post('/', [OrderController::class, 'productAdd',]);
    });
});
Route::prefix('category')->group(function() {
    Route::get('/', [CategoryController::class, 'list',]);
    Route::get('/{id}', [CategoryController::class, 'one',]);
    Route::post('/{id}', [CategoryController::class, 'set',]);
});
Route::prefix('product')->group(function() {
    Route::get('/', [ProductController::class, 'list',]);
    Route::post('/', [ProductController::class, 'add',]);
    Route::get('/{id}', [ProductController::class, 'one',]);
    Route::post('/{id}', [ProductController::class, 'set',]);
    Route::post('/{id}/del', [ProductController::class, 'del',]);
    Route::post('/{product_id}/category/{category_id}', [ProductController::class, 'addCategory',]);
    Route::post('/{product_id}/category/{category_id}/del', [ProductController::class, 'delCategory',]);
});