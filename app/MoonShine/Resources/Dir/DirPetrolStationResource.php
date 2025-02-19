<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Dir;

use MoonShine\Support\ListOf;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Laravel\Enums\Action;
use App\Models\Dir\DirPetrolStation;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\DirPetrolStation\DirPetrolStationFormPage;
use App\MoonShine\Pages\DirPetrolStation\DirPetrolStationIndexPage;

class DirPetrolStationResource extends ModelResource
{
    protected string $model = DirPetrolStation::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.petrol_stations');
    }

    protected string $column = 'title';

    protected bool $createInModal = true;

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(
                Action::MASS_DELETE
            );
    }

    protected function pages(): array
    {
        return [
            DirPetrolStationIndexPage::class,
            DirPetrolStationFormPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }
}
