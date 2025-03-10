<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Refilling;

use App\MoonShine\Resources\Dir\DirPetrolStationResource;
use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use App\MoonShine\Resources\UserResource;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Components\Heading;

class RefillingFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
            BelongsTo::make(
                'driver',
                'driver',
                formatted: 'profile.SurnameInitials',
                resource: UserResource::class
            )->translatable('moonshine::ui.field'),
            Text::make('num_liters_car_refueling')->translatable('moonshine::ui.field'),
            //Text::make('price_car_refueling')->translatable('moonshine::ui.field'),
            //Text::make('cost_car_refueling')->translatable('moonshine::ui.field'),
            BelongsTo::make(
                'petrol_station',
                'petrolStation',
                formatted: 'title',
                resource: DirPetrolStationResource::class
            )->translatable('moonshine::ui.field'),
            Text::make('comment')->translatable('moonshine::ui.field'),
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
