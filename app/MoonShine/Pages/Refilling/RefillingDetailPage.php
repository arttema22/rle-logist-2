<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Refilling;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use ForestLynx\MoonShine\Fields\Decimal;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;

class RefillingDetailPage extends DetailPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
            Text::make('driver', 'driver.profile.SurnameInitials')->translatable('moonshine::ui.field'),
            Decimal::make('num_liters_car_refueling')
                ->unit('unit', ['л.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('price_car_refueling')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('cost_car_refueling')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Text::make('petrol_station', 'petrolStation.title')->translatable('moonshine::ui.field'),
            Text::make('comment')->translatable('moonshine::ui.field'),
            Date::make('created_at')->format('d.m.Y')->translatable('moonshine::ui.field'),
            Date::make('updated_at')->format('d.m.Y')->translatable('moonshine::ui.field'),
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
