<?php

use App\Http\Controllers\SalaryContriller;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';



// Группа Зарплата
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
