<?php

use App\Http\Controllers\RefillingController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SalaryContriller;
use App\MoonShine\Controllers\ClosePeriodController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

require __DIR__ . '/moonshine.php';

// Группа Выплаты
Route::name('salary.')
    ->prefix('salary')
    // ->namespace('Salary')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        //Route::get('', SalaryManager::class)->name('list');
        Route::get('', [SalaryContriller::class, 'index'])->name('list');
        // Route::get('/archive', [SalaryController::class, 'archive'])->name('archive');
        // Route::get('/create', [SalaryController::class, 'create'])->name('create');
        // Route::post('/store', [SalaryController::class, 'store'])->name('store');
        // Route::get('/edit/{id}', [SalaryController::class, 'edit'])->name('edit');
        // Route::post('/update/{id}', [SalaryController::class, 'update'])->name('update');
        // Route::get('/destroy/{id}', [SalaryController::class, 'destroy'])->name('destroy');
    });

// Группа Заправки
Route::name('refilling.')
    ->prefix('refilling')
    // ->namespace('Refilling')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        //Route::get('', SalaryManager::class)->name('list');
        Route::get('', [RefillingController::class, 'index'])->name('list');
        // Route::get('/archive', [SalaryController::class, 'archive'])->name('archive');
        // Route::get('/create', [SalaryController::class, 'create'])->name('create');
        // Route::post('/store', [SalaryController::class, 'store'])->name('store');
        // Route::get('/edit/{id}', [SalaryController::class, 'edit'])->name('edit');
        // Route::post('/update/{id}', [SalaryController::class, 'update'])->name('update');
        // Route::get('/destroy/{id}', [SalaryController::class, 'destroy'])->name('destroy');
    });

// Группа Маршруты
Route::name('route.')
    ->prefix('route')
    // ->namespace('Route')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        //Route::get('', SalaryManager::class)->name('list');
        Route::get('', [RouteController::class, 'index'])->name('list');
        // Route::get('/archive', [SalaryController::class, 'archive'])->name('archive');
        // Route::get('/create', [SalaryController::class, 'create'])->name('create');
        // Route::post('/store', [SalaryController::class, 'store'])->name('store');
        // Route::get('/edit/{id}', [SalaryController::class, 'edit'])->name('edit');
        // Route::post('/update/{id}', [SalaryController::class, 'update'])->name('update');
        // Route::get('/destroy/{id}', [SalaryController::class, 'destroy'])->name('destroy');
    });
