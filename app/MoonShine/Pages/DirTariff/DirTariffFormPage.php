<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\DirTariff;

use Throwable;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Switcher;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\Dir\DirTypeTruckResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

class DirTariffFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Text::make('start')->translatable('moonshine::ui.field'),
            Text::make('end')->translatable('moonshine::ui.field'),
            Text::make('price')->translatable('moonshine::ui.field'),
            Switcher::make('type_calculation')->translatable('moonshine::ui.field')
                ->hint(__('moonshine::ui.calculate_by_mileage')),
            BelongsTo::make(
                'typetruck',
                'typetruck',
                resource: DirTypeTruckResource::class
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
