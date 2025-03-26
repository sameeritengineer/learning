<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCategoriesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PastworkController;
use App\Http\Controllers\Admin\OperatedDomainkController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TechFactorController;
use App\Http\Controllers\Admin\CaseStudyController;
use App\Http\Controllers\Admin\IndustryInsightController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PressReleaseController;


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
        Route::delete('/{id}/delete', [BlogController::class, 'delete'])->name('admin.blog.delete');

        // Blog Categories Routes
        Route::prefix('categories')->group(function () {
            Route::get('/', [BlogCategoriesController::class, 'index'])->name('admin.blog.categories.index');
            Route::post('/store', [BlogCategoriesController::class, 'store'])->name('admin.blog.categories.store');
            Route::get('/{id}/edit', [BlogCategoriesController::class, 'edit'])->name('admin.blog.categories.edit');
            Route::post('/{id}/update', [BlogCategoriesController::class, 'update'])->name('admin.blog.categories.update');
            Route::delete('/{id}/delete', [BlogCategoriesController::class, 'delete'])->name('admin.blog.categories.delete');
        });
    });

    // Section Routes
    Route::prefix('section')->group(function () {
        // Home Page Settings
        Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
        Route::post('/home/talent-pool', [HomeController::class, 'updateTalentPool'])->name('admin.home.talent-pool');
        Route::post('/home/retention', [HomeController::class, 'updateRetention'])->name('admin.home.retention');
        Route::resource('home/testimonials', TestimonialController::class);
        Route::resource('home/pastwork', PastworkController::class);
        Route::resource('home/operated_domains', OperatedDomainkController::class);
        Route::post('/home/operated_domain/{id}/delete-logo', [OperatedDomainkController::class, 'deleteLogo']);

        // Team Page
        Route::resource('team', TeamController::class)->names('team');
        
        // Tech Factor
        Route::resource('tech-factor', TechFactorController::class)->names('tech-factor');
        
        // Case Studies
        Route::resource('case-studies', CaseStudyController::class)->names('case-studies');

        Route::resource('industry-insights',IndustryInsightController::class)->names('industry-insights');

        //News
        Route::resource('news', NewsController::class)->names('news');
        
        //Press Release
        Route::resource('press-release', PressReleaseController::class)->names('press-release');

    });
});
