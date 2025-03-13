<?php

namespace App;

use Carbon\Carbon;
use App\Models\Refilling;
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
}
