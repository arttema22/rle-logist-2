<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\RealtimeProfit;

use Throwable;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Position;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;

class RealtimeProfitIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            Position::make(),

            Text::make('name', 'profile.SurnameInitials')->translatable('moonshine::ui.field')
                ->columnSelection(false),

            Text::make('saldo_start', 'profit.saldo_end')
                ->badge()
                ->translatable('moonshine::ui.field'),

            Text::make(
                'salaries',
                formatted: fn($item) => ($item->salaries_count != 0) ?
                    $item->salaries_count . ' - ' . $item->salaries_sum_salary : ''

            )->translatable('moonshine::ui.field'),

            Text::make(
                'routes',
                formatted: fn($item) => ($item->routes_count != 0) ?
                    $item->routes_count . ' - ' . $item->routes_sum_summ_route : ''
            )->translatable('moonshine::ui.field'),

            Text::make(
                'refillings',
                formatted: fn($item) => ($item->refillings_count != 0) ?
                    $item->refillings_count . ' - ' . $item->refillings_sum_cost_car_refueling : ''
            )->translatable('moonshine::ui.field'),

            Text::make(
                'services',
                formatted: fn($item) => ($item->services_count != 0) ?
                    $item->services_count . ' - ' . $item->services_sum_sum : ''
            )->translatable('moonshine::ui.field'),

            Text::make(
                'turnover',
                formatted: fn($item) => ($item->services_count != 0) ?
                    $item->routes_sum_summ_route + $item->services_sum_sum - $item->salaries_sum_salary :
                    $item->routes_sum_summ_route - $item->refillings_sum_cost_car_refueling - $item->salaries_sum_salary
            )
                ->badge()
                ->translatable('moonshine::ui.field'),

            Text::make(
                label: 'saldo_end',
                formatted: function ($item) {
                    if ($item->profit) {
                        if ($item->services_count != 0) {
                            return $item->profit->saldo_end + $item->routes_sum_summ_route + $item->services_sum_sum - $item->salaries_sum_salary;
                        } else {
                            return $item->profit->saldo_end + $item->routes_sum_summ_route - $item->refillings_sum_cost_car_refueling - $item->salaries_sum_salary;
                        }
                    } else {
                        if ($item->services_count != 0) {
                            return $item->routes_sum_summ_route + $item->services_sum_sum - $item->salaries_sum_salary;
                        } else {
                            return $item->routes_sum_summ_route - $item->refillings_sum_cost_car_refueling - $item->salaries_sum_salary;
                        }
                    }
                }
            )
                ->badge()
                ->translatable('moonshine::ui.field'),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
