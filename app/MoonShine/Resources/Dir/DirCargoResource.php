<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Dir;

use App\Models\Dir\DirCargo;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Laravel\Resources\ModelResource;

#[Icon('cube')]
class DirCargoResource extends ModelResource
{
    protected string $model = DirCargo::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.cargos');
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
            Text::make('title', 'title')->translatable('moonshine::ui.field')->sortable(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Text::make('title', 'title')->translatable('moonshine::ui.field'),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }
}
