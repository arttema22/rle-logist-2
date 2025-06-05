<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Setup;

use App\Models\Setup\Truck;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Select;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Attributes\Icon;

use Illuminate\Database\Eloquent\Model;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Flex;
use App\MoonShine\Pages\Truck\TruckFormPage;
use App\MoonShine\Pages\Truck\TruckIndexPage;
use App\MoonShine\Pages\Truck\TruckDetailPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;

#[Icon('truck')]
class TruckResource extends ModelResource
{
    protected string $model = Truck::class;

    protected array $with = [
        'type',
    ];

    public function getTitle(): string
    {
        return __('moonshine::ui.title.trucks');
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            TruckIndexPage::class,
            TruckFormPage::class,
            TruckDetailPage::class,
        ];
    }


    // protected function formFields(): iterable
    // {
    //     return [
    //         Box::make([

    //             Select::make('Country', 'country_id')
    //                 ->options([
    //                     'value 1' => 'Option Label 1',
    //                     'value 2' => 'Option Label 2',
    //                 ])->nullable()->searchable(),

    //             HasOne::make('truck', 'truck', resource: TruckResource::class)
    //                 ->fields([
    //                     //Phone::make('Phone'),
    //                     Text::make('name')->translatable('moonshine::ui.field'),
    //                 ]),
    //             Flex::make([
    //                 Text::make('name')->translatable('moonshine::ui.field'),
    //                 Text::make('reg_num_ru')->translatable('moonshine::ui.field'),
    //             ]),

    //         ])
    //     ];
    // }

    /**
     * @param Truck $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
