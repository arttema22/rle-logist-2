<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\User;

use Throwable;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Components\Collapse;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;

class UserFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                Flex::make([
                    Text::make('name')->translatable('moonshine::ui')->required(),
                    Email::make('email')->translatable('moonshine::ui')->required(),
                ]),
                Collapse::make(__('moonshine::ui.resource.change_password'), [
                    Password::make(__('moonshine::ui.resource.password'), 'password')
                        ->customAttributes(['autocomplete' => 'new-password'])
                        ->eye(),

                    PasswordRepeat::make(__('moonshine::ui.resource.repeat_password'), 'password_repeat')
                        ->customAttributes(['autocomplete' => 'confirm-password'])
                        ->eye(),
                ])->icon('lock-closed'),
            ]),
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
