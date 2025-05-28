<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Truck;

use App\Models\Dir\DirTruckBrand;
use App\MoonShine\Resources\Dir\DirTruckBrandResource;
use App\MoonShine\Resources\Dir\DirTypeTruckResource;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Fields\Text;
use Throwable;


class TruckFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Text::make('name'),
            Text::make('reg_num_ru'),
            Text::make('reg_num_en'),
            BelongsTo::make(
                'brand',
                'brand',
                resource: DirTruckBrandResource::class,
                formatted: 'name'
            ),
            BelongsTo::make(
                'type',
                'type',
                resource: DirTypeTruckResource::class,
                formatted: 'title'
            ),

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
