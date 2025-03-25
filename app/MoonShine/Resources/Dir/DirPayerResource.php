<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Dir;


use App\Models\Dir\DirPayer;
use MoonShine\Support\ListOf;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\DirPayer\DirPayerFormPage;
use App\MoonShine\Pages\DirPayer\DirPayerIndexPage;

#[Icon('user-group')]
class DirPayerResource extends ModelResource
{
    protected string $model = DirPayer::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.payers');
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
            DirPayerIndexPage::class,
            DirPayerFormPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }
}
