<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Refilling;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\Text;
use App\Enums\TypeFuelEnumCast;
use ForestLynx\MoonShine\Fields\Decimal;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;

class RefillingIndexPage extends IndexPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
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
            Enum::make('type', 'type_fuel')->attach(TypeFuelEnumCast::class)->sortable()->translatable('moonshine::ui.field'),
            Text::make('comment')->translatable('moonshine::ui.field'),
            Date::make('created_at')->format('d.m.Y H:i')->translatable('moonshine::ui.field')->sortable(),
            Date::make('updated_at')->format('d.m.Y H:i')->translatable('moonshine::ui.field')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer(),
            // Alert::make(type: 'warning')->content('Внимание, изменения в системе! Большинство записей о заправке поступает в
            // систему автоматически. Обмен данными происходит каждые 5 минут.<br>
            //     Делайте запись о заправке после того, как убедитесь, что ее нет в системе.'),
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
