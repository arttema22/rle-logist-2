<?php

namespace App;

use App\Models\Stat\StatRoutes;
use App\Models\Stat\StatSalaries;
use Carbon\Carbon;
use App\Models\Refilling;
use App\Models\Route;
use App\Models\Salary;

use function Termwind\parse;
use App\Models\Stat\StatRefilling;

class StatisticMonthly
{
    public function callRefillings()
    {
        // $date = date('2022-09-17');
        // $start = Carbon::parse($date)->firstOfMonth();
        // $end = Carbon::parse($date)->lastOfMonth();
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');

        $refillings = Refilling::whereDate('date', '>=', $start)
            ->whereDate('date', '<=', $end)
            ->get();

        StatRefilling::create([
            'date_from' => $start,
            'date_to' => $end,
            'count_refillings' => $refillings->count(),
            'count_liters' => $refillings->sum('num_liters_car_refueling'),
            'sum_refillings' => $refillings->sum('cost_car_refueling'),
            'average_price_liter' => $refillings->avg('price_car_refueling'),
        ]);
    }

    public function callSalaries()
    {
        // $date = date('2022-09-17');
        // $start = Carbon::parse($date)->firstOfMonth();
        // $end = Carbon::parse($date)->lastOfMonth();
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');

        $salaries = Salary::whereDate('date', '>=', $start)
            ->whereDate('date', '<=', $end)
            ->get();

        StatSalaries::create([
            'date_from' => $start,
            'date_to' => $end,
            'count_salaries' => $salaries->count(),
            'sum_salaries' => $salaries->sum('salary'),
            'average_sum' => $salaries->avg('salary'),
        ]);
    }

    public function callRoutes()
    {
        // $date = date('2022-09-17');
        // $start = Carbon::parse($date)->firstOfMonth();
        // $end = Carbon::parse($date)->lastOfMonth();
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');

        $routes = Route::whereDate('date', '>=', $start)
            ->whereDate('date', '<=', $end)
            ->get();

        StatRoutes::create([
            'date_from' => $start,
            'date_to' => $end,
            'count_routes' => $routes->count(),
            'length_routes' => $routes->sum('route_length'),
            'sum_routes' => $routes->sum('summ_route'),
            'average_sum' => $routes->avg('summ_route'),
        ]);
    }
}
