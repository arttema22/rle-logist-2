<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Service;
use MoonShine\UI\Fields\ID;

use MoonShine\Support\ListOf;
use MoonShine\Laravel\Enums\Action;
use Illuminate\Database\Eloquent\Model;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Service>
 */
class ServiceResource extends ModelResource
{
    protected string $model = Service::class;

    protected string $title = 'Services';

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(
                Action::MASS_DELETE,
                Action::CREATE,
                Action::VIEW,
                Action::UPDATE,
                Action::DELETE
            );
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
        ];
    }

    /**
     * @param Service $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
