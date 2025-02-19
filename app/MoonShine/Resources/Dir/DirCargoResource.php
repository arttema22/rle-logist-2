<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Dir;

use App\Models\Dir\DirCargo;
use MoonShine\Support\ListOf;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\DirCargo\DirCargoFormPage;
use App\MoonShine\Pages\DirCargo\DirCargoIndexPage;

class DirCargoResource extends ModelResource
{
    protected string $model = DirCargo::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.cargos');
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
            DirCargoIndexPage::class,
            DirCargoFormPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }
}
