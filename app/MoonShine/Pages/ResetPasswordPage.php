<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Hidden;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Fields\Password;
use App\MoonShine\Layouts\FormLayout;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\ComponentContract;


class ResetPasswordPage extends Page
{
    protected ?string $layout = FormLayout::class;

    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'ResetPasswordPage';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            FormBuilder::make()
                ->class('authentication-form')
                ->action(route('password.update'))
                ->fields([
                    Hidden::make('token')->setValue(request()->route('token')),

                    Text::make('E-mail', 'email')
                        ->setValue(request()->input('email'))
                        ->required()
                        ->readonly(),

                    Password::make(__('Password'), 'password')
                        ->required(),

                    PasswordRepeat::make(__('Repeat password'), 'password_confirmation')
                        ->required(),
                ])->submit(__('Reset password'), [
                    'class' => 'btn-primary btn-lg w-full',
                ]),
        ];
    }
}
