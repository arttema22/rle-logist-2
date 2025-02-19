<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Dir;

use App\Models\Dir\DirTariff;
use MoonShine\Support\ListOf;
use MoonShine\Laravel\Pages\Page;

use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\DirTariff\DirTariffFormPage;
use App\MoonShine\Pages\DirTariff\DirTariffIndexPage;

class DirTariffResource extends ModelResource
{
    protected string $model = DirTariff::class;

    protected string $title = 'Dir/DirTariffs';

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
            DirTariffIndexPage::class,
            DirTariffFormPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }
}
