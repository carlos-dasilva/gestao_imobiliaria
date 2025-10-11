<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyPublicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\PropertyTypeController as AdminPropertyTypeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/imoveis', [PropertyPublicController::class, 'index'])->name('properties.index');
Route::get('/imoveis/{slug}', [PropertyPublicController::class, 'show'])->name('properties.show');

// Auth routes
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('types', AdminPropertyTypeController::class)->parameters([
        'types' => 'type'
    ])->except(['show']);

    Route::resource('properties', AdminPropertyController::class)->parameters([
        'properties' => 'property'
    ]);
    Route::post('properties/{property}/images/{image}/cover', [AdminPropertyController::class, 'setCover'])->name('properties.images.cover');
    Route::delete('properties/{property}/images/{image}', [AdminPropertyController::class, 'deleteImage'])->name('properties.images.destroy');

    Route::resource('users', AdminUserController::class)->parameters([
        'users' => 'user'
    ])->except(['show']);
});
