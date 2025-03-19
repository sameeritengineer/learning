<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCategoriesController;

// Admin Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login']);

// Protected Admin Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {

    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Ensure this view exists
    })->name('admin.dashboard');

    // Admin Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Blog Routes
    Route::prefix('blog')->group(function () {

        Route::get('/', [BlogController::class, 'index'])->name('admin.blog.index');
        Route::get('/create', [BlogController::class, 'create'])->name('admin.blog.create');
        Route::post('/store', [BlogController::class, 'store'])->name('admin.blog.store');
        Route::post('/search', [BlogController::class, 'search'])->name('admin.blog.search');
        Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
        Route::post('/{id}/update', [BlogController::class, 'update'])->name('admin.blog.update');
        Route::get('/{id}/delete', [BlogController::class, 'delete'])->name('admin.blog.delete');

        // Blog Categories Routes
        Route::prefix('categories')->group(function () {

            Route::get('/', [BlogCategoriesController::class, 'index'])->name('admin.blog.categories.index');
            Route::post('/store', [BlogCategoriesController::class, 'store'])->name('admin.blog.categories.store');
            Route::get('/{id}/edit', [BlogCategoriesController::class, 'edit'])->name('admin.blog.categories.edit');
            Route::post('/{id}/update', [BlogCategoriesController::class, 'update'])->name('admin.blog.categories.update');
            Route::get('/{id}/delete', [BlogCategoriesController::class, 'delete'])->name('admin.blog.categories.delete');

        });

    });

});
