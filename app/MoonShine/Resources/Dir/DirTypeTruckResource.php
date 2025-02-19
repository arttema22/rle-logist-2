<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Dir;

use MoonShine\Support\ListOf;
use App\Models\Dir\DirTypeTruck;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\DirTypeTruck\DirTypeTruckFormPage;
use App\MoonShine\Pages\DirTypeTruck\DirTypeTruckIndexPage;

class DirTypeTruckResource extends ModelResource
{
    protected string $model = DirTypeTruck::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.typetrucks');
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
            DirTypeTruckIndexPage::class,
            DirTypeTruckFormPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }
}
