<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Profile;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Profile>
 */
class ProfileResource extends ModelResource
{
    protected string $model = Profile::class;

    protected string $title = 'Profiles';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            Text::make('last_name')->translatable('moonshine::ui.field'),
            Text::make('first_name')->translatable('moonshine::ui.field'),
            Text::make('sec_name')->translatable('moonshine::ui.field'),
            Text::make('phone')->translatable('moonshine::ui.field'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                Flex::make([
                    Text::make('last_name')->translatable('moonshine::ui.field'),
                    Text::make('first_name')->translatable('moonshine::ui.field'),
                    Text::make('sec_name')->translatable('moonshine::ui.field'),
                ]),
                Flex::make([
                    Text::make('phone')->translatable('moonshine::ui.field'),
                ]),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            Box::make([
                Flex::make([
                    Text::make('last_name')->translatable('moonshine::ui.field'),
                    Text::make('first_name')->translatable('moonshine::ui.field'),
                    Text::make('sec_name')->translatable('moonshine::ui.field'),
                ]),
                Flex::make([
                    Text::make('phone')->translatable('moonshine::ui.field'),
                ]),
            ])
        ];
    }

    /**
     * @param Profile $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
