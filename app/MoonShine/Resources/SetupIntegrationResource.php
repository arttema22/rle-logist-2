<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\UI\Fields\ID;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Enums\Action;
use App\Models\Sys\SetupIntegration;
use MoonShine\Support\Attributes\Icon;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;

#[Icon('share')]
class SetupIntegrationResource extends ModelResource
{
    protected string $model = SetupIntegration::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.integrations');
    }

    protected ?string $alias = 'integrations';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    protected bool $columnSelection = true;

    protected bool $stickyTable = true;

    protected bool $stickyButtons = true;

    protected string $column = 'name';

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(
                Action::MASS_DELETE
            );
    }

    protected function indexFields(): iterable
    {
        return [
            Text::make('name')->sortable()->translatable('moonshine::ui.field'),
            Url::make('help_api')->blank()
                ->title(fn(string $url, Url $ctx) => str($url)->limit(3))
                ->translatable('moonshine::ui.field'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                Text::make('name')->translatable('moonshine::ui.field'),
                Url::make('url')->translatable('moonshine::ui.field'),

                Text::make('user_name')->translatable('moonshine::ui.field'),
                Text::make('password')->translatable('moonshine::ui.field'),
                Textarea::make('access_token')->translatable('moonshine::ui.field'),
                Json::make('additionally')->keyValue()->creatable()
                    ->removable()->translatable('moonshine::ui.field'),
                Url::make('help_api')->translatable('moonshine::ui.field'),
                Textarea::make('comment')->translatable('moonshine::ui.field'),
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
     * @param SetupIntegration $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
