<?php

use Illuminate\Support\Facades\Schedule;

// Получение данных о заправках из интеграции
Schedule::command('e1card:transaction')->everyFiveMinutes();
