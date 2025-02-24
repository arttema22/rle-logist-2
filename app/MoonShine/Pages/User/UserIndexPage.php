<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\User;

use Throwable;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Phone;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;

class UserIndexPage extends IndexPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Text::make('name')->translatable('moonshine::ui.field')->sortable(),
            Email::make('email')->translatable('moonshine::ui.field')->sortable(),
            Text::make('last_name', 'profile.last_name')->translatable('moonshine::ui.field'),
            Text::make('first_name', 'profile.first_name')->translatable('moonshine::ui.field'),
            Text::make('sec_name', 'profile.sec_name')->translatable('moonshine::ui.field'),
            Phone::make('phone', 'profile.phone')->translatable('moonshine::ui.field'),
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
