<?php

use Illuminate\Support\Facades\Schedule;

// Получение данных о заправках из интеграции
Schedule::command('e1card:transaction')->everyFiveMinutes();

// Сбор статистики о заправках. Ежемесячно.
Schedule::command('stat:create-monthly-refillings')->monthlyOn(20, '01:00');
