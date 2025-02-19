<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Salary;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;


class SalaryIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
            Text::make('driver', 'driver.profile.SurnameInitials')->translatable('moonshine::ui.field'),
            Number::make('salary')->translatable('moonshine::ui.field')->sortable(),
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
