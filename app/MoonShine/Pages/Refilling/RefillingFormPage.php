<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Refilling;

use Throwable;
use App\Models\Refilling;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Enum;
use App\Enums\TypeFuelEnumCast;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\Setup\UserResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use App\MoonShine\Resources\Dir\DirPetrolStationResource;

class RefillingFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Div::make([
                Grid::make([
                    Column::make(
                        [
                            Flex::make([
                                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),

                                BelongsTo::make(
                                    'driver',
                                    'driver',
                                    formatted: 'profile.SurnameInitials',
                                    resource: UserResource::class
                                )->translatable('moonshine::ui.field'),

                            ]),

                            Flex::make([
                                BelongsTo::make(
                                    'petrol_station',
                                    'petrolStation',
                                    formatted: 'title',
                                    resource: DirPetrolStationResource::class
                                )->translatable('moonshine::ui.field'),

                                Enum::make('Type', 'type_fuel')
                                    ->attach(TypeFuelEnumCast::class)
                                    ->native()
                                    ->xModel(),
                            ]),

                            Flex::make([
                                Number::make('num_liters_car_refueling')
                                    ->xModel()
                                    ->translatable('moonshine::ui.field'),

                                Number::make('price_car_refueling')
                                    ->translatable('moonshine::ui.field')
                                    ->xModel()
                                    ->xIf('type_fuel', Refilling::TYPE_BENZINE),
                            ]),
                        ],
                        colSpan: 8,
                        adaptiveColSpan: 12
                    ),
                    Column::make(
                        [
                            Div::make()
                                ->xDisplay('(num_liters_car_refueling * price_car_refueling)')
                                ->class('report-card-value'),

                        ],
                        colSpan: 4,
                        adaptiveColSpan: 12
                    ),
                ]),

                Textarea::make('comment')->translatable('moonshine::ui.field'),

            ])->xData([
                'num_liters_car_refueling' => null,
                'price_car_refueling' => env('PRICE_CAR_REFUELING'),
                'type_fuel' => Refilling::TYPE_DIESEL,
            ]),

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
