<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Salary;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Textarea;
use ForestLynx\MoonShine\Fields\Decimal;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\Setup\UserResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

class SalaryFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Flex::make([
                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                BelongsTo::make(
                    'driver',
                    'driver',
                    formatted: 'profile.SurnameInitials',
                    resource: UserResource::class
                )->translatable('moonshine::ui.field'),
                Number::make('salary')->required()
                    ->default(100)
                    ->min(100)->max(9999999.99)->step(0.01)
                    ->suffix('руб.')
                    ->buttons()
                    ->translatable('moonshine::ui.field'),
            ]),
            Textarea::make('comment')->translatable('moonshine::ui.field'),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
