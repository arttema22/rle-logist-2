<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Dir;

use MoonShine\UI\Fields\Text;
use App\Models\Dir\DirTruckBrand;
use MoonShine\Support\Attributes\Icon;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;

#[Icon('truck')]
class DirTruckBrandResource extends ModelResource
{
    protected string $model = DirTruckBrand::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.brandtrucks');
    }

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            //ID::make()->sortable(),
            Text::make('name'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                //ID::make(),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            //ID::make(),
        ];
    }

    /**
     * @param DirTruckBrand $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
