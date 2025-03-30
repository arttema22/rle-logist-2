<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Pages\Page;
use App\MoonShine\Layouts\FormLayout;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Layout\Divider;
use MoonShine\Contracts\UI\ComponentContract;


class ForgotPage extends Page
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
        return $this->title ?: 'ForgotPage';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            FormBuilder::make()
                ->class('authentication-form')
                ->action(route('forgot'))
                ->fields([
                    Text::make('E-mail', 'email')
                        ->required()
                        ->customAttributes([
                            'autofocus' => true,
                            'autocomplete' => 'off',
                        ]),
                ])->submit(__('Reset password'), [
                    'class' => 'btn-primary btn-lg w-full',
                ]),

            Divider::make(),

            Flex::make([
                ActionButton::make(__('Log in'), route('login'))->primary(),
            ])->justifyAlign('start')
        ];
    }
}
