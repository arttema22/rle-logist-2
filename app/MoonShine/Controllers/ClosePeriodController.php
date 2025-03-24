<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Route;
use App\Models\Profit;
use App\Models\Salary;
use App\Models\Service;
use App\Models\Refilling;
use App\Http\Requests\ProfitCreateRequest;
use MoonShine\Laravel\Http\Controllers\MoonShineController;

final class ClosePeriodController extends MoonShineController
{
    /**
     * closePeriod
     *
     * @param  mixed $request
     * @return void
     */
    public function closePeriod(ProfitCreateRequest $request)
    {
        $monthName = Carbon::parse($request->input('date'))->translatedFormat('F'); // название месяца
        $user = User::find($request->input('driver_id')); // получаем пользователя

        // Создание и сохранение новой записи о выплатах
        $profit = new Profit();
        $profit->date = $request->input('date');
        $profit->title = $monthName;
        $profit->owner_id = $request->input('owner_id');
        $profit->driver_id = $user->id;
        (is_null($user->profit)) ? $profit->saldo_start = 0 : $profit->saldo_start = $user->profit->saldo_end;
        $profit->sum_salary = $user->salaries->where('status', 1)->where('date', '<=', $profit->date)->sum('salary');
        $profit->sum_refuelings = $user->refillings->where('status', 1)->where('date', '<=', $profit->date)->sum('cost_car_refueling');
        $profit->sum_routes = $user->routes->where('status', 1)->where('date', '<=', $profit->date)->sum('summ_route');
        $profit->sum_services = $user->services->where('status', 1)->where('date', '<=', $profit->date)->sum('sum');
        if ($profit->sum_services != 0) {
            $profit->sum_accrual = $profit->sum_routes + $profit->sum_services;
        } else {
            $profit->sum_accrual = $profit->sum_routes - $profit->sum_refuelings;
        }
        $profit->sum_amount = $profit->sum_accrual - $profit->sum_salary;
        $profit->saldo_end = $profit->saldo_start + $profit->sum_amount;
        $profit->comment = $request->input('comment');
        $profit->save();

        // смена статуса и присвоение profit_id всем записям вошедшим в период закрытия
        Salary::where('status', 1)
            ->where('driver_id', $user->id)
            ->where('date', '<=', $profit->date)
            ->update(['status' => 0, 'profit_id' => $profit->id]);
        // // смена статуса и присвоение profit_id всем записям вошедшим в период закрытия
        Refilling::where('status', 1)
            ->where('driver_id', $user->id)
            ->where('date', '<=', $profit->date)
            ->update(['status' => 0, 'profit_id' => $profit->id]);
        // // смена статуса и присвоение profit_id всем записям вошедшим в период закрытия
        Route::where('status', 1)
            ->where('driver_id', $user->id)
            ->where('date', '<=', $profit->date)
            ->update(['status' => 0, 'profit_id' => $profit->id]);
        // // смена статуса и присвоение profit_id всем записям вошедшим в период закрытия
        Service::where('status', 1)
            ->where('driver_id', $user->id)
            ->where('date', '<=', $profit->date)
            ->update(['status' => 0]);

        // return redirect(toPage(RealtimeProfitIndexPage::class, RealtimeProfitResource::class))
    }
}
