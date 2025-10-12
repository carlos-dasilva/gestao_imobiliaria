<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyPublicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\PropertyTypeController as AdminPropertyTypeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\PrivacyController as AdminPrivacyController;
use App\Http\Controllers\Admin\TermsController as AdminTermsController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/imoveis', [PropertyPublicController::class, 'index'])->name('properties.index');
Route::get('/imoveis/{slug}', [PropertyPublicController::class, 'show'])->name('properties.show');

// Static pages
Route::view('/quem-somos', 'pages.quem-somos')->name('about');
Route::view('/politica-de-privacidade', 'pages.politica-privacidade')->name('privacy');
Route::view('/termos-de-uso', 'pages.termos-uso')->name('terms');

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

    // System diagnostics (upload settings)
    Route::get('sys-info', function () {
        $keys = [
            'upload_max_filesize',
            'post_max_size',
            'max_file_uploads',
            'file_uploads',
            'memory_limit',
            'upload_tmp_dir',
        ];

        $ini = [];
        foreach ($keys as $k) {
            $ini[$k] = ini_get($k);
        }

        $sapi = php_sapi_name();
        $phpVersion = PHP_VERSION;
        $sysTmp = sys_get_temp_dir();
        $confTmp = $ini['upload_tmp_dir'] ?: null;
        $appTmp = storage_path('app/tmp');

        $checks = [
            'sys_tmp' => [
                'path' => $sysTmp,
                'writable' => is_writable($sysTmp),
            ],
            'conf_tmp' => [
                'path' => $confTmp,
                'writable' => $confTmp ? is_writable($confTmp) : null,
            ],
            'app_tmp' => [
                'path' => $appTmp,
                'exists' => file_exists($appTmp),
                'writable' => is_writable($appTmp),
            ],
        ];

        return view('admin.sys-info', compact('ini','sapi','phpVersion','sysTmp','confTmp','appTmp','checks'));
    })->name('sys-info');

    // Settings (singleton-style)
    Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');

    // Quem Somos (singleton-style)
    Route::get('about', [AdminAboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [AdminAboutController::class, 'update'])->name('about.update');

    // Política de Privacidade (singleton-style)
    Route::get('privacy', [AdminPrivacyController::class, 'edit'])->name('privacy.edit');
    Route::put('privacy', [AdminPrivacyController::class, 'update'])->name('privacy.update');

    // Termos de Uso (singleton-style)
    Route::get('terms', [AdminTermsController::class, 'edit'])->name('terms.edit');
    Route::put('terms', [AdminTermsController::class, 'update'])->name('terms.update');
});
