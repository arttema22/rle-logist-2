<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Route;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use ForestLynx\MoonShine\Fields\Decimal;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use App\MoonShine\Resources\ServiceResource;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\Dir\DirServiceResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

class RouteIndexPage extends IndexPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
            Text::make('driver', 'driver.profile.SurnameInitials')->translatable('moonshine::ui.field'),
            Text::make('typetruck', 'typeTruck.title')->translatable('moonshine::ui.field'),
            Text::make('cargo', 'cargo.title')->translatable('moonshine::ui.field'),
            Text::make('payer', 'payer.title')->translatable('moonshine::ui.field'),
            Text::make('address_loading')->translatable('moonshine::ui.field')->sortable(),
            Text::make('address_unloading')->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('length', 'route_length')
                ->unit('unit', ['км.'])->unitDefault(0)->precision(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('price', 'price_route')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Text::make('number_trips', 'number_trips')->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('unexpected_expenses')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('summ_route')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Text::make('comment')->translatable('moonshine::ui.field'),
            Date::make('created_at')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
            Date::make('updated_at')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
            HasMany::make(
                'service',
                'services',
                resource: ServiceResource::class
            )->fields([
                BelongsTo::make('service', 'service', resource: DirServiceResource::class)
                    ->translatable('moonshine::ui.field'),
                Number::make('price')->translatable('moonshine::ui.field'),
                Number::make('number_operations')->translatable('moonshine::ui.field'),
                Number::make('sum')->translatable('moonshine::ui.field'),
                Text::make('comment')->translatable('moonshine::ui.field'),
            ])->translatable('moonshine::ui.field')->relatedLink(),
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
