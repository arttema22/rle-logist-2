<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\RealtimeProfit;

use MoonShine\Support\Enums\FormMethod;
use MoonShine\UI\Fields\Textarea;
use Throwable;
use App\Models\User;
use App\Models\Salary;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\Text;
use App\Enums\TypeFuelEnumCast;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Components\Modal;
use MoonShine\UI\Fields\StackFields;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Components\OffCanvas;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\UI\Components\ActionButton;
use App\MoonShine\Resources\RouteResource;
use App\MoonShine\Resources\SalaryResource;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Laravel\TypeCasts\ModelCaster;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Layout\LineBreak;
use App\MoonShine\Resources\RefillingResource;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Traits\Fields\HasVerticalMode;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\FormBuilder;

class RealtimeProfitDetailPage extends DetailPage
{

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Text::make('name', 'profile.SurnameInitials')->translatable('moonshine::ui.field')->sortable()
                ->columnSelection(false),

            Text::make('saldo_start', 'profit.saldo_end')
                ->translatable('moonshine::ui.field'),


            StackFields::make('routes')->fields([
                Text::make(
                    'routes',
                    'routes',
                    formatted: fn($item) => $item->routes->count()
                )->translatable('moonshine::ui.field'),
                LineBreak::make(),
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
                LineBreak::make(),
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
                LineBreak::make(),
                Text::make(
                    'salaries',
                    'salaries',
                    formatted: fn($item) => $item->salaries->sum('salary')
                )->translatable('moonshine::ui.field'),
            ])->translatable('moonshine::ui.field'),

            Text::make(
                'saldo_end',
                'profit.saldo_end',
                formatted: fn($item) => $item->profit->saldo_end + $item->routes->sum('summ_route') -
                    $item->refillings->sum('cost_car_refueling') - $item->salaries->sum('salary')
            )
                ->translatable('moonshine::ui.field'),

            $this->getRoutesField(),
            $this->getRefillingsField(),
            $this->getSalariesField(),

            // ActionButton::make('Показать модальное окно')
            //     ->toggleOffCanvs('my-canvas'),

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
                    'data',
                    formatted: fn($item) => $item->address_loading
                        . ' - ' . $item->address_unloading
                        . ' - ' . $item->route_length
                )->translatable('moonshine::ui.field'),
                Text::make('price_route')->translatable('moonshine::ui.field'),
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
                Enum::make('type', 'type_fuel')->attach(TypeFuelEnumCast::class)->sortable()->translatable('moonshine::ui.field'),
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
                Tab::make('routes', [
                    Box::make([
                        $this->getResource()->getItem() ? $this->getRoutesField() : 'To add comments, save the article',
                    ]),
                ])->translatable('moonshine::ui.title'),
                Tab::make('refillings', [
                    Box::make([
                        $this->getResource()->getItem() ? $this->getRefillingsField() : 'To add comments, save the article',
                    ]),
                ])->translatable('moonshine::ui.title'),
                Tab::make('salaries', [
                    Box::make([
                        $this->getResource()->getItem() ? $this->getSalariesField() : 'To add comments, save the article',
                    ]),
                ])->translatable('moonshine::ui.title'),
            ]),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        dd($this);
        $test = $this->getResource();
        return [
            Modal::make(
                'close_period',
                'Content',
                '',
                null,
                [
                    FormBuilder::make('test', FormMethod::POST, [
                        Date::make('date'),
                        Text::make('name', 'profile.SurnameInitials')->translatable('moonshine::ui.field'),
                        Text::make('name', 'email'), //->setValue($this),
                        Text::make('name', 'name'), //->setValue($this),
                        Textarea::make('test'),
                    ])
                        ->fill($test)
                    //  ->cast(new ModelCaster(User::class)),
                ]
            )
                ->name('close-periodmy-modal'),

            LineBreak::make(),
            ActionButton::make('close_period')
                ->icon('pencil')
                ->primary()
                ->toggleModal('close-periodmy-modal'),
            // ...parent::bottomLayer()
        ];
    }
}
