<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Dir;

use App\Models\Dir\DirRoute;
use MoonShine\Support\ListOf;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\DirRoute\DirRouteFormPage;
use App\MoonShine\Pages\DirRoute\DirRouteIndexPage;

class DirRouteResource extends ModelResource
{
    protected string $model = DirRoute::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.routes');
    }

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
            DirRouteIndexPage::class,
            DirRouteFormPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }
}
