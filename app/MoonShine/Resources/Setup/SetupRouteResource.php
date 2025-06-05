<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Setup;

use MoonShine\Support\ListOf;
use App\Models\Setup\SetupRoute;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\DirRoute\DirRouteFormPage;
use App\MoonShine\Pages\DirRoute\DirRouteIndexPage;

#[Icon('arrow-path-rounded-square')]
class SetupRouteResource extends ModelResource
{
    protected string $model = SetupRoute::class;

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
