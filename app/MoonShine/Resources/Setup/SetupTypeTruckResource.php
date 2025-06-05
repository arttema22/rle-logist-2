<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Setup;

use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Range;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Switcher;
use MoonShine\Laravel\Enums\Action;
use App\Models\Setup\SetupTypeTruck;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

#[Icon('truck')]
class SetupTypeTruckResource extends ModelResource
{
    protected string $model = SetupTypeTruck::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.typetrucks');
    }

    protected string $column = 'title';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(
                Action::MASS_DELETE,
                Action::VIEW
            );
    }

    protected function indexFields(): iterable
    {
        return [
            Text::make('title')->translatable('moonshine::ui.field')->sortable(),
            Switcher::make('is_service')->translatable('moonshine::ui.field')->sortable(),
            HasMany::make(
                'tariff',
                'tariffs',
                resource: SetupTariffResource::class
            )->fields([
                Position::make(),
                Range::make('distance')
                    ->fromTo('start', 'end')->translatable('moonshine::ui.field'),
                Text::make('price')->translatable('moonshine::ui.field')->badge('info'),
                Switcher::make('type_calculation')->translatable('moonshine::ui.field'),
            ])->translatable('moonshine::ui.field'),

        ];
    }

    protected function formFields(): iterable
    {
        return [
            Text::make('title')->translatable('moonshine::ui.field')->required(),
            Switcher::make('is_service')
                ->translatable('moonshine::ui.field')
                ->hint(__('moonshine::ui.services_available')),
            // HasMany::make(
            //     'tariff',
            //     'tariffs',
            //     resource: SetupTariffResource::class
            // )->fields([
            //     Text::make('start')->translatable('moonshine::ui.field'),
            //     Text::make('end')->translatable('moonshine::ui.field'),
            //     Text::make('price')->translatable('moonshine::ui.field'),
            //     Switcher::make('type_calculation')->translatable('moonshine::ui.field'),
            // ])->creatable()->translatable('moonshine::ui.field')

        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }
}
