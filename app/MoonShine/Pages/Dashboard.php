<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Pages\Page;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Laravel\Resources\CrudResource;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\CardsBuilder;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\Core\CrudResourceContract;

class Dashboard extends Page
{
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
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            CardsBuilder::make(
                [
                    ['id' => 1, 'title' => 'Заголовок 1'],
                    ['id' => 2, 'title' => 'Заголовок 2'],
                ],
                [
                    ID::make(),
                    Text::make('title')
                ]
            )
                ->title('title')
                ->subtitle(static fn() => 'Subtitle')
                ->content('Custom content')
                ->buttons([
                    ActionButton::make('Delete', route('home')),
                    ActionButton::make('Edit', route('home'))->showInDropdown(),
                    ActionButton::make('Go to Home', route('home'))->blank(),
                ]),
        ];
    }
}
