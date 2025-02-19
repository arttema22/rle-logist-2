<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\DirTypeTruck;

use Throwable;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Range;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\StackFields;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\Dir\DirTariffResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

class DirTypeTruckIndexPage extends IndexPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Text::make('title')->translatable('moonshine::ui.field')->sortable(),
            Switcher::make('is_service')->translatable('moonshine::ui.field')->sortable(),
            HasMany::make(
                'tariff',
                'tariffs',
                resource: DirTariffResource::class
            )->fields([
                Position::make(),
                Range::make('distance')
                    ->fromTo('start', 'end')->translatable('moonshine::ui.field'),
                Text::make('price')->translatable('moonshine::ui.field')->badge('info'),
                Switcher::make('type_calculation')->translatable('moonshine::ui.field'),
            ])->translatable('moonshine::ui.field'),
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
