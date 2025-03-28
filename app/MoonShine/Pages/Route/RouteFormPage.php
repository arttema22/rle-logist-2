<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Route;

use App\Models\RouteBilling;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Fields\Select;
use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Components\Layout\Box;
use App\MoonShine\Resources\UserResource;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use App\MoonShine\Resources\ServiceResource;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\Dir\DirCargoResource;
use App\MoonShine\Resources\Dir\DirPayerResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use App\MoonShine\Resources\Dir\DirTypeTruckResource;
use ForestLynx\MoonShine\Fields\Decimal;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

class RouteFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                Flex::make([
                    Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                ]),

                Flex::make([
                    BelongsTo::make(
                        'payer',
                        'payer',
                        formatted: 'title',
                        resource: DirPayerResource::class
                    )
                        ->creatable()
                        ->nullable()
                        ->searchable()
                        ->translatable('moonshine::ui.field'),
                    BelongsTo::make(
                        'cargo',
                        'cargo',
                        formatted: 'title',
                        resource: DirCargoResource::class
                    )
                        ->creatable()
                        ->nullable()
                        ->searchable()
                        ->translatable('moonshine::ui.field'),
                ]),

                Flex::make([
                    BelongsTo::make(
                        'driver',
                        'driver',
                        formatted: 'profile.SurnameInitials',
                        resource: UserResource::class
                    )
                        ->nullable()
                        ->searchable()
                        ->translatable('moonshine::ui.field'),
                    BelongsTo::make(
                        'typetruck',
                        'typeTruck',
                        formatted: 'title',
                        resource: DirTypeTruckResource::class
                    )
                        ->nullable()
                        ->searchable()
                        ->translatable('moonshine::ui.field'),
                ]),

                Flex::make([
                    Number::make('number_trips', 'number_trips')->setValue(1)->translatable('moonshine::ui.field'),
                    Number::make('unexpected_expenses', 'unexpected_expenses')
                        //    ->unit('unit', ['руб.'])->unitDefault(0)
                        ->translatable('moonshine::ui.field'),
                ])->justifyAlign('between')
                    ->itemsAlign('start'),

                // RouteBilling
                Select::make('route')
                    ->options(
                        RouteBilling::query()
                            ->selectRaw('CONCAT(start, " - ", finish) as route, id')
                            ->pluck('route', 'id')
                            ->toArray()
                    )
                    ->nullable()
                    ->searchable()
                    ->name('route')
                    ->translatable('moonshine::ui.field'),

                Text::make('address_loading')->translatable('moonshine::ui.field'),
                Text::make('address_unloading')->translatable('moonshine::ui.field'),
                Text::make('length', 'route_length')->translatable('moonshine::ui.field'),
                Text::make('price', 'price_route')->translatable('moonshine::ui.field'),
                Text::make('summ_route', 'summ_route')->translatable('moonshine::ui.field'),
                Text::make('comment')->translatable('moonshine::ui.field'),
            ]),
            // $this->getServicesField(),
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
