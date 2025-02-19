<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\DirRoute;

use Throwable;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;

class DirRouteIndexPage extends IndexPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Text::make('start')->translatable('moonshine::ui.field')->sortable(),
            Text::make('finish')->translatable('moonshine::ui.field')->sortable(),
            Text::make('length')->translatable('moonshine::ui.field')->sortable()->badge(),
            Number::make('price')->translatable('moonshine::ui.field')->sortable()->badge('info'),
            Switcher::make('is_static')->translatable('moonshine::ui.field')->sortable(),
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
