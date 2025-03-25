<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Dir;

use MoonShine\Support\ListOf;
use App\Models\Dir\DirService;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\DirService\DirServiceFormPage;
use App\MoonShine\Pages\DirService\DirServiceIndexPage;

#[Icon('circle-stack')]
class DirServiceResource extends ModelResource
{
    protected string $model = DirService::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.services');
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
            DirServiceIndexPage::class,
            DirServiceFormPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }
}
