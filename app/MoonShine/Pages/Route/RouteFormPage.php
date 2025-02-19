<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Route;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use App\Models\Dir\DirTypeTruck;
use App\MoonShine\Resources\UserResource;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use App\MoonShine\Resources\ServiceResource;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\Dir\DirCargoResource;
use App\MoonShine\Resources\Dir\DirPayerResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use App\MoonShine\Resources\Dir\DirTypeTruckResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

class RouteFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
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
            ])->creatable(),
            Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
            BelongsTo::make(
                'driver',
                'driver',
                formatted: 'profile.SurnameInitials',
                resource: UserResource::class
            )->translatable('moonshine::ui.field'),
            BelongsTo::make(
                'typetruck',
                'typeTruck',
                formatted: 'title',
                resource: DirTypeTruckResource::class
            )->translatable('moonshine::ui.field'),
            BelongsTo::make(
                'cargo',
                'cargo',
                formatted: 'title',
                resource: DirCargoResource::class
            )->translatable('moonshine::ui.field'),
            BelongsTo::make(
                'payer',
                'payer',
                formatted: 'title',
                resource: DirPayerResource::class
            )->translatable('moonshine::ui.field'),
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
