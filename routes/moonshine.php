<?php

use Illuminate\Support\Facades\Route;
use App\MoonShine\Controllers\ClosePeriodController;

Route::prefix('/close')
    ->as('close.')
    ->controller(ClosePeriodController::class)
    ->group(function () {

        Route::post('', 'closePeriod')->name('period');
    });
