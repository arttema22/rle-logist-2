<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\User;

use Throwable;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\StackFields;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Layout\LineBreak;

class UserIndexPage extends IndexPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            StackFields::make('name')->fields([
                Text::make('last_name', 'profile.last_name')->translatable('moonshine::ui.field'),
                LineBreak::make(),
                Text::make('first_name', 'profile.first_name')->translatable('moonshine::ui.field'),
                Text::make('sec_name', 'profile.sec_name')->translatable('moonshine::ui.field'),
            ])->translatable('moonshine::ui.field'),

            StackFields::make('truck')->fields([
                Text::make('truck.type.title')->translatable('moonshine::ui.field'),
                Text::make('truck.reg_num_ru')->translatable('moonshine::ui.field'),
                LineBreak::make(),
                Text::make('truck.brand.name')->translatable('moonshine::ui.field'),
                Text::make('truck.name')->translatable('moonshine::ui.field'),
            ])->translatable('moonshine::ui.field'),

            Email::make('email')->translatable('moonshine::ui.field')->sortable(),


            Phone::make('phone', 'profile.phone')->translatable('moonshine::ui.field'),
            Text::make('e1_card')->translatable('moonshine::ui.field'),
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
