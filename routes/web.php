<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [PageController::class, 'servicesIndex'])->name('index');
    Route::get('/{slug}', [PageController::class, 'serviceShow'])->name('show');
});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [PageController::class, 'productsIndex'])->name('index');
    Route::get('/{slug}', [PageController::class, 'productsShow'])->name('show');
});

Route::prefix('clients')->name('clients.')->group(function () {
    Route::get('/', [PageController::class, 'clientsIndex'])->name('index');
    Route::get('/{slug}', [PageController::class, 'clientsShow'])->name('show');
});

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [PageController::class, 'blogIndex'])->name('index');
    Route::get('/{slug}', [PageController::class, 'blogShow'])->name('show');
});

Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', [PageController::class, 'projectsIndex'])->name('index');
    Route::get('/{slug}', [PageController::class, 'projectShow'])->name('show');
});

Route::get('/contact', [PageController::class, 'contactCreate'])->name('contact.create');
Route::post('/contact', [PageController::class, 'contactStore'])->name('contact.store');