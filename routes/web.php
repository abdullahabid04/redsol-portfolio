<?php

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
