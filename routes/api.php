<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::get('/posts', [BlogController::class, 'index']);
    Route::get('/posts/{id}', [BlogController::class, 'show']);
	Route::get('/featured-posts', [BlogController::class, 'getTopFeaturedPosts']);
});