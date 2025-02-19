<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Route;

use App\MoonShine\Resources\Dir\DirServiceResource;
use App\MoonShine\Resources\ServiceResource;
use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Fields\Number;

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
            Text::make('length', 'route_length')->translatable('moonshine::ui.field')->sortable(),
            Text::make('price', 'price_route')->translatable('moonshine::ui.field')->sortable(),
            Text::make('number_trips', 'number_trips')->translatable('moonshine::ui.field')->sortable(),
            Text::make('unexpected_expenses', 'unexpected_expenses')->translatable('moonshine::ui.field')->sortable(),
            Text::make('summ_route', 'summ_route')->translatable('moonshine::ui.field')->sortable(),
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
