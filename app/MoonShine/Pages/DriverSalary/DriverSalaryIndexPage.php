<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\DriverSalary;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Textarea;
use ForestLynx\MoonShine\Fields\Decimal;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;


class DriverSalaryIndexPage extends IndexPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Position::make(),
            Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('salary', 'salary')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Textarea::make('comment')->translatable('moonshine::ui.field'),
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
