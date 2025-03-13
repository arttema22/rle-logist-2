<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Refilling;

use Closure;
use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Components\Alert;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Collections\TableRows;
use MoonShine\UI\Collections\TableCells;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Components\Table\TableRow;
use MoonShine\Contracts\UI\TableRowContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\Collection\TableRowsContract;

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
            Text::make('num_liters_car_refueling')->translatable('moonshine::ui.field')->sortable(),
            Text::make('price_car_refueling')->translatable('moonshine::ui.field')->sortable(),
            Text::make('cost_car_refueling')->translatable('moonshine::ui.field')->sortable(),
            Text::make('petrol_station', 'petrolStation.title')->translatable('moonshine::ui.field'),
            Text::make('comment')->translatable('moonshine::ui.field'),
            Date::make('created_at')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
            Date::make('updated_at')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
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
            Alert::make(type: 'warning')->content('Внимание, изменения в системе! Большинство записей о заправке поступает в
            систему автоматически. Обмен данными происходит каждые 5 минут.<br>
                Делайте запись о заправке после того, как убедитесь, что ее нет в системе.'),
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
