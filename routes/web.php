<?php

use App\Http\Controllers\HisModuleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [PageController::class, 'productsIndex'])->name('index');
    Route::get('/his', [PageController::class, 'productsHis'])->name('his');
    Route::get('/campus-management-system', [PageController::class, 'productsCms'])->name('cms');
});

Route::get('/services/custom-software-development', [PageController::class, 'servicesCustomDev'])->name('services.custom-dev');

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [PageController::class, 'blogIndex'])->name('index');
    Route::get('/{slug}', [PageController::class, 'blogShow'])->name('show');
});

// Module listing page
Route::get('/products', [HisModuleController::class, 'index'])->name('products.index');

// Module detail page (dynamic)
Route::get('/products/{slug}', [HisModuleController::class, 'show'])->name('products.show');
