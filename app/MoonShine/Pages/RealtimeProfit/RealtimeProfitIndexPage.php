<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\RealtimeProfit;

use Throwable;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Switcher;
use ForestLynx\MoonShine\Fields\Decimal;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;

use function PHPUnit\Framework\isEmpty;

class RealtimeProfitIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            Position::make(),
            Text::make('name', 'profile.SurnameInitials')->translatable('moonshine::ui.field')
                ->columnSelection(false),

            // Decimal::make('saldo_start', 'profit.saldo_end')
            //     ->unit('unit', ['руб.'])->unitDefault(0)->badge()
            //     ->translatable('moonshine::ui.field')->sortable(),

            Text::make('saldo_start', 'profit.saldo_end')
                ->badge()
                ->translatable('moonshine::ui.field')->sortable(),

            Text::make(
                'salaries',
                formatted: fn($item) => ($item->salaries->isNotEmpty()) ? $item->salaries->count() . ' - ' . $item->salaries->sum('salary') : ''
            )->translatable('moonshine::ui.field'),

            Text::make(
                'routes',
                formatted: fn($item) => ($item->routes->isNotEmpty()) ? $item->routes->count() . ' - ' . $item->routes->sum('summ_route') : ''
            )->translatable('moonshine::ui.field'),

            Text::make(
                'refillings',
                formatted: fn($item) => ($item->refillings->isNotEmpty()) ? $item->refillings->count() . ' - ' . $item->refillings->sum('cost_car_refueling') : ''
            )->translatable('moonshine::ui.field'),

            Text::make(
                'services',
                formatted: fn($item) => ($item->services->isNotEmpty()) ? $item->services->count() . ' - ' . $item->services->sum('sum') : ''
            )->translatable('moonshine::ui.field'),

            Switcher::make('services', 'typeTruck.is_service')->translatable('moonshine::ui.field'),

            Text::make(
                'turnover',
                formatted: fn($item) => ($item->typeTruck->is_service) ?
                    $item->routes->sum('summ_route') + $item->services->sum('sum') - $item->salaries->sum('salary') :
                    $item->routes->sum('summ_route') - $item->refillings->sum('cost_car_refueling') - $item->salaries->sum('salary')
            )
                ->badge()
                ->translatable('moonshine::ui.field'),

            Text::make(
                label: 'saldo_end',
                formatted: function ($item) {
                    // У нового пользователя нет истории профитов, поэтому проверка на их наличие.
                    // Если профиты есть, то получаем конечное сальдо последнего профита
                    $res = ($item->profit) ? $item->profit->saldo_end : 0;
                    // Если есть маршруты, то их сумму прибавляем к результату
                    $res = ($item->routes) ? $res + $item->routes->sum('summ_route') : $res;
                    // Если есть выплаты, то вычитаем их из результата
                    $res = ($item->salaries) ? $res - $item->salaries->sum('salary') : $res;
                    // Если есть услуги, то суммируем их по стоимости
                    $service = ($item->services) ? $item->services->sum('sum') : 0;
                    // Если пользователю разрешено оказывать услуги, то к результату прибавляем стоимость всех услуг
                    // иначе из результата вычитаем сумму заправок
                    $res = ($item->typeTruck->is_service) ? $res + $service : $res - $item->refillings->sum('cost_car_refueling');
                    return $res;
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
