<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\RealtimeProfit;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\Text;
use App\Enums\TypeFuelEnumCast;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\StackFields;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\RouteResource;
use App\MoonShine\Resources\ProfitResource;
use App\MoonShine\Resources\SalaryResource;
use App\MoonShine\Resources\ServiceResource;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\RefillingResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

class RealtimeProfitDetailPage extends DetailPage
{

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            StackFields::make('name')->fields([
                Text::make('profile.last_name'),
                Text::make('profile.first_name'),
                Text::make('profile.sec_name'),
            ])->translatable('moonshine::ui.field'),

            Text::make('saldo_start', 'profit.saldo_end')
                ->badge()
                ->translatable('moonshine::ui.field'),

            StackFields::make('routes')->fields([
                Text::make(
                    'routes',
                    'routes',
                    formatted: fn($item) => $item->routes->count()
                )->translatable('moonshine::ui.field'),
                //LineBreak::make(),
                Text::make(
                    'routes',
                    'routes',
                    formatted: fn($item) => $item->routes->sum('summ_route')
                )->translatable('moonshine::ui.field'),
            ])->translatable('moonshine::ui.field'),

            StackFields::make('refillings')->fields([
                Text::make(
                    'refillings',
                    'refillings',
                    formatted: fn($item) => $item->refillings->count()
                )->translatable('moonshine::ui.field'),
                //LineBreak::make(),
                Text::make(
                    'refillings',
                    'refillings',
                    formatted: fn($item) => $item->refillings->sum('cost_car_refueling')
                )->translatable('moonshine::ui.field'),
            ])->translatable('moonshine::ui.field'),

            StackFields::make('salaries')->fields([
                Text::make(
                    'salaries',
                    'salaries',
                    formatted: fn($item) => $item->salaries->count()
                )->translatable('moonshine::ui.field'),
                //LineBreak::make(),
                Text::make(
                    'salaries',
                    'salaries',
                    formatted: fn($item) => $item->salaries->sum('salary')
                )->translatable('moonshine::ui.field'),
            ])->translatable('moonshine::ui.field'),

            StackFields::make('services')->fields([
                Text::make(
                    'services',
                    'services',
                    formatted: fn($item) => $item->services->count()
                )->translatable('moonshine::ui.field'),
                // LineBreak::make(),
                Text::make(
                    'services',
                    'services',
                    formatted: fn($item) => $item->services->sum('sum')
                )->translatable('moonshine::ui.field'),
            ])->translatable('moonshine::ui.field'),

            Text::make(
                'turnover',
                formatted: fn($item) => ($item->services->count() != 0) ?
                    $item->routes->sum('summ_route') + $item->services->sum('sum') - $item->salaries->sum('salary') :
                    $item->routes->sum('summ_route') - $item->refillings->sum('cost_car_refueling') - $item->salaries->sum('salary')
            )->badge()
                ->translatable('moonshine::ui.field'),

            Text::make(
                'saldo_end',
                'profit.saldo_end',
                formatted: function ($item) {
                    if ($item->profit) {
                        if ($item->services->count() != 0) {
                            return $item->profit->saldo_end + $item->routes->sum('summ_route') + $item->services->sum('sum') - $item->salaries->sum('salary');
                        } else {
                            return $item->profit->saldo_end + $item->routes->sum('summ_route') - $item->refillings->sum('cost_car_refueling') - $item->salaries->sum('salary');
                        }
                    } else {
                        if ($item->services_count != 0) {
                            return $item->routes->sum('summ_route') + $item->services->sum('sum') - $item->salaries->sum('salary');
                        } else {
                            return $item->routes->sum('summ_route') - $item->refillings->sum('cost_car_refueling') - $item->salaries->sum('salary');
                        }
                    }
                }
            )->badge()
                ->translatable('moonshine::ui.field'),

            $this->getRoutesField(),
            $this->getRefillingsField(),
            $this->getSalariesField(),
            $this->getServicesField(),
            $this->getProfitsField(),
        ];
    }

    private function getRoutesField(): HasMany
    {
        return HasMany::make(
            'routes',
            'routes',
            resource: RouteResource::class
        )
            ->fields([
                Position::make(),
                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                Text::make(
                    'route',
                    formatted: fn($item) => $item->address_loading
                        . ' - ' . $item->address_unloading
                        . ' - ' . $item->route_length
                )->translatable('moonshine::ui.field'),
                Text::make('price', 'price_route')->translatable('moonshine::ui.field'),
                Text::make('number_trips')->translatable('moonshine::ui.field'),
                Text::make('unexpected_expenses')->translatable('moonshine::ui.field'),
                Text::make('summ_route')->translatable('moonshine::ui.field'),
                Text::make('comment')->translatable('moonshine::ui.field'),
            ])
            ->fillData($this->getResource()->getItem())
            ->async()
            ->creatable()
        ;
    }

    private function getRefillingsField(): HasMany
    {
        return HasMany::make(
            'refillings',
            'refillings',
            resource: RefillingResource::class
        )
            ->fields([
                Position::make(),
                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                Text::make('petrol_station', 'petrolStation.title')->translatable('moonshine::ui.field'),
                Enum::make('type', 'type_fuel')->attach(TypeFuelEnumCast::class)->translatable('moonshine::ui.field'),
                Text::make('num_liters_car_refueling')->translatable('moonshine::ui.field'),
                Text::make('price_car_refueling')->translatable('moonshine::ui.field'),
                Text::make('cost_car_refueling')->translatable('moonshine::ui.field'),
                Text::make('comment')->translatable('moonshine::ui.field'),
            ])
            ->fillData($this->getResource()->getItem())
            ->async()
            ->creatable()
        ;
    }

    private function getSalariesField(): HasMany
    {
        return
            HasMany::make(
                'salaries',
                'salaries',
                resource: SalaryResource::class
            )
            ->fields([
                Position::make(),
                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                Text::make('salary')->translatable('moonshine::ui.field'),
                Text::make('comment')->translatable('moonshine::ui.field'),
            ])
            ->fillData($this->getResource()->getItem())
            ->async()
            ->creatable()
        ;
    }

    private function getServicesField(): HasMany
    {
        return
            HasMany::make(
                'services',
                'services',
                resource: ServiceResource::class
            )
            ->fields([
                Position::make(),
                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                Text::make('price')->translatable('moonshine::ui.field'),
                Text::make('number_operations')->translatable('moonshine::ui.field'),
                Text::make('sum')->translatable('moonshine::ui.field'),
                Text::make('comment')->translatable('moonshine::ui.field'),
            ])
            ->fillData($this->getResource()->getItem())
            ->async()
            ->creatable()
        ;
    }

    private function getProfitsField(): HasMany
    {
        return
            HasMany::make(
                'profits',
                'profits',
                resource: ProfitResource::class
            )
            ->fields([
                Position::make(),
                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                Text::make('title')->translatable('moonshine::ui.field'),
                Text::make('saldo_start')->translatable('moonshine::ui.field'),
                Text::make('sum_salary')->translatable('moonshine::ui.field'),
                Text::make('sum_refuelings')->translatable('moonshine::ui.field'),
                Text::make('sum_routes')->translatable('moonshine::ui.field'),
                Text::make('sum_services')->translatable('moonshine::ui.field'),
                Text::make('sum_accrual')->translatable('moonshine::ui.field'),
                Text::make('turnover', 'sum_amount')->translatable('moonshine::ui.field'),
                Text::make('saldo_end')->translatable('moonshine::ui.field'),
                Text::make('comment')->translatable('moonshine::ui.field'),
            ])
            ->fillData($this->getResource()->getItem())
            ->async()
            ->creatable()
        ;
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
            Tabs::make([
                Tab::make('main', parent::mainLayer())
                    ->translatable('moonshine::ui.title'),

                Tab::make('profits', [
                    Box::make([
                        $this->getResource()->getItem() ? $this->getProfitsField() : 'To add comments, save the article',
                    ]),
                ])->translatable('moonshine::ui.title'),

                Tab::make('salaries', [
                    Box::make([
                        $this->getResource()->getItem() ? $this->getSalariesField() : 'To add comments, save the article',
                    ]),
                ])->translatable('moonshine::ui.title'),

                Tab::make('refillings', [
                    Box::make([
                        $this->getResource()->getItem() ? $this->getRefillingsField() : 'To add comments, save the article',
                    ]),
                ])->translatable('moonshine::ui.title'),

                Tab::make('routes', [
                    Box::make([
                        $this->getResource()->getItem() ? $this->getRoutesField() : 'To add comments, save the article',
                    ]),
                ])->translatable('moonshine::ui.title'),

                Tab::make('services', [
                    Box::make([
                        $this->getResource()->getItem() ? $this->getServicesField() : 'To add comments, save the article',
                    ]),
                ])->translatable('moonshine::ui.title'),
            ])
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            // ...parent::bottomLayer()
        ];
    }
}
