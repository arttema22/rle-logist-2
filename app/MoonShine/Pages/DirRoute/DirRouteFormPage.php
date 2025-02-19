<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\DirRoute;

use Throwable;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;

class DirRouteFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Text::make('start')->translatable('moonshine::ui.field'),
            Text::make('finish')->translatable('moonshine::ui.field'),
            Text::make('length')->translatable('moonshine::ui.field'),
            Number::make('price')->translatable('moonshine::ui.field')->badge('info'),
            Switcher::make('is_static')->translatable('moonshine::ui.field'),
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
