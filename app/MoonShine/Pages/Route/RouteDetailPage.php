<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Route;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Components\Layout\Box;
use ForestLynx\MoonShine\Fields\Decimal;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\ServiceResource;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\HasMany;

class RouteDetailPage extends DetailPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
            Text::make('driver', 'driver.profile.SurnameInitials')->translatable('moonshine::ui.field'),
            Text::make('typetruck', 'typeTruck.title')->translatable('moonshine::ui.field'),
            Text::make('cargo', 'cargo.title')->translatable('moonshine::ui.field'),
            Text::make('payer', 'payer.title')->translatable('moonshine::ui.field'),
            Text::make('address_loading')->translatable('moonshine::ui.field'),
            Text::make('address_unloading')->translatable('moonshine::ui.field'),
            Decimal::make('length', 'route_length')
                ->unit('unit', ['км.'])->unitDefault(0)->precision(0)
                ->translatable('moonshine::ui.field'),
            Decimal::make('price', 'price_route')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field'),
            Text::make('number_trips', 'number_trips')->translatable('moonshine::ui.field'),
            Decimal::make('unexpected_expenses')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field'),
            Decimal::make('summ_route')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field'),
            Text::make('comment')->translatable('moonshine::ui.field'),
            Date::make('created_at')->format('d.m.Y')->translatable('moonshine::ui.field'),
            Date::make('updated_at')->format('d.m.Y')->translatable('moonshine::ui.field'),
            $this->getServicesField(),
        ];
    }

    private function getServicesField(): HasMany
    {
        return
            HasMany::make(
                'services',
                'services',
                resource: ServiceResource::class
            )
            ->fields([
                Position::make(),
                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                Text::make('service', 'dirService.title')->translatable('moonshine::ui.field'),
                Text::make('price')->translatable('moonshine::ui.field'),
                Text::make('number_operations')->translatable('moonshine::ui.field'),
                Text::make('sum')->translatable('moonshine::ui.field'),
                Text::make('comment')->translatable('moonshine::ui.field'),
            ])
            ->fillData($this->getResource()->getItem())
            ->async()
            ->creatable()
        ;
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
            Tabs::make(
                [
                    Tab::make('main', parent::mainLayer())
                        ->translatable('moonshine::ui.title'),
                    Tab::make('services', [
                        Box::make([
                            $this->getResource()->getItem() ? $this->getServicesField() : 'To add comments, save the article',
                        ]),
                    ])->translatable('moonshine::ui.title'),
                ]
            ),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            // ...parent::bottomLayer()
        ];
    }
}
