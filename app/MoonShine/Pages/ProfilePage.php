<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Hidden;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\Tabs\Tab;
use App\MoonShine\Layouts\DriverLayout;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Traits\WithComponentsPusher;


class ProfilePage extends Page
{
    use WithComponentsPusher;

    protected ?string $layout = DriverLayout::class;
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
        return __('moonshine::ui.profile');
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            Box::make([
                FormBuilder::make()
                    ->class('authentication-form')
                    ->action(route('profile.update'))
                    ->fill(auth()->user())
                    ->fields([
                        Tabs::make([
                            Tab::make(
                                __('moonshine::ui.resource.main_information'),
                                [
                                    Text::make(__('moonshine::ui.resource.name'), 'name')->required(),
                                    Text::make(__('moonshine::ui.resource.email'), 'email')
                                        ->required()
                                        ->customAttributes([
                                            'autofocus' => true,
                                            'autocomplete' => 'off',
                                        ]),
                                ]
                            ),
                            Tab::make(
                                __('moonshine::ui.resource.password'),
                                [
                                    Heading::make(__('moonshine::ui.resource.change_password')),
                                    Password::make(__('moonshine::ui.resource.password'), 'password'),
                                    PasswordRepeat::make(__('moonshine::ui.resource.repeat_password'), 'password_confirmation'),
                                ]
                            )->active(
                                session('errors')?->has('password') ?? false
                            )
                        ])
                    ])->submit(__('moonshine::ui.save'), [
                        'class' => 'btn-lg btn-primary',
                    ]),
            ]),
            ...$this->getPushedComponents(),
        ];
    }
}
