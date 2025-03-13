<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Refilling;

use App\Enums\TypeFuelEnumCast;
use App\Models\Refilling;
use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Components\Badge;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Layout\Grid;
use App\MoonShine\Resources\UserResource;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use App\MoonShine\Resources\Dir\DirPetrolStationResource;
use MoonShine\UI\Fields\Enum;

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
                                ->xDisplay('"Result:<br>" + (num_liters_car_refueling * price_car_refueling)')
                                ->class('report-card-value'),

                        ],
                        colSpan: 4,
                        adaptiveColSpan: 12
                    ),
                ]),

                Textarea::make('comment')->translatable('moonshine::ui.field'),

            ])->xData([
                'num_liters_car_refueling' => 0,
                'price_car_refueling' => env('PRICE_CAR_REFUELING'),
                'type_fuel' => Refilling::TYPE_DIESEL,
            ]),

            //Text::make('cost_car_refueling')->translatable('moonshine::ui.field'),


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
