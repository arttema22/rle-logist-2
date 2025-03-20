<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\RealtimeProfit;

use Throwable;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Preview;
use App\MoonShine\Resources\RouteResource;
use App\MoonShine\Resources\ProfitResource;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use MoonShine\Laravel\Fields\Relationships\HasMany;

class RealtimeProfitIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            Text::make('name', 'profile.SurnameInitials')->translatable('moonshine::ui.field')->sortable()
                ->columnSelection(false),

            Text::make('saldo_start', 'profit.saldo_end')
                ->translatable('moonshine::ui.field'),

            Text::make(
                'salaries',
                formatted: fn($item) => $item->salaries_count
                    . ' - ' . $item->salaries_sum_salary
            )->translatable('moonshine::ui.field'),

            Text::make(
                'routes',
                formatted: fn($item) => $item->routes_count
                    . ' - ' . $item->routes_sum_summ_route
            )->translatable('moonshine::ui.field'),

            Text::make(
                'refillings',
                formatted: fn($item) => $item->refillings_count
                    . ' - ' . $item->refillings_sum_cost_car_refueling
            )->translatable('moonshine::ui.field'),

            Text::make(
                label: 'turnover',
                formatted: fn($item) => $item->routes_sum_summ_route - $item->refillings_sum_cost_car_refueling - $item->salaries_sum_salary
            )->translatable('moonshine::ui.field'),

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
