<?php

use Illuminate\Support\Facades\Route;
use App\MoonShine\Pages\ResetPasswordPage;
use App\MoonShine\Controllers\ForgotController;
use App\MoonShine\Controllers\ProfileController;
use App\MoonShine\Controllers\AuthenticateController;

Route::controller(AuthenticateController::class)->group(function () {
    Route::get('/login', 'form')->middleware('guest')->name('login');
    Route::post('/login', 'authenticate')->middleware('guest')->name('authenticate');
    Route::get('/logout', 'logout')->middleware('auth')->name('logout');
});

Route::controller(ForgotController::class)->middleware('guest')->group(function () {
    Route::get('/forgot', 'form')->name('forgot');
    Route::post('/forgot', 'reset');
    Route::get('/reset-password/{token}', static fn(ResetPasswordPage $page) => $page)->name('password.reset');
    Route::post('/reset-password', 'updatePassword')->name('password.update');
});

Route::controller(ProfileController::class)
    ->middleware(['auth', 'verified'])
    ->prefix('profile')
    ->group(function () {
        Route::get('/', 'index')->name('profile');
        Route::post('/', 'update')->name('profile.update');
    });
