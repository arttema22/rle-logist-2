<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Route;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
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
            Text::make('length', 'route_length')->translatable('moonshine::ui.field'),
            Text::make('price', 'price_route')->translatable('moonshine::ui.field'),
            Text::make('number_trips', 'number_trips')->translatable('moonshine::ui.field'),
            Text::make('unexpected_expenses', 'unexpected_expenses')->translatable('moonshine::ui.field'),
            Text::make('summ_route', 'summ_route')->translatable('moonshine::ui.field'),
            Text::make('comment')->translatable('moonshine::ui.field'),
            Date::make('created_at')->format('d.m.Y')->translatable('moonshine::ui.field'),
            Date::make('updated_at')->format('d.m.Y')->translatable('moonshine::ui.field'),
            HasMany::make(
                'services',
                'services',
                resource: ServiceResource::class
            )->fields([
                Text::make('service_id'),
                Number::make('price'),
                Number::make('number_operations'),
                Number::make('sum'),
                Text::make('comment'),
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
