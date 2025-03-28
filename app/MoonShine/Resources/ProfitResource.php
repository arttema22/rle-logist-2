<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Profit;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Support\Attributes\Icon;
use MoonShine\UI\Components\Layout\Box;
use ForestLynx\MoonShine\Fields\Decimal;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

#[Icon('scale')]
class ProfitResource extends ModelResource
{
    protected string $model = Profit::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.profits');
    }

    protected ?string $alias = 'profits';

    protected bool $columnSelection = true;

    protected bool $stickyTable = true;

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(
                Action::CREATE,
                Action::UPDATE,
                Action::VIEW,
                Action::DELETE,
                Action::MASS_DELETE
            );
    }

    protected function indexFields(): iterable
    {
        return [
            Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
            Text::make('title')->translatable('moonshine::ui.field'),
            Text::make('driver', 'driver.profile.SurnameInitials')->translatable('moonshine::ui.field'),
            Decimal::make('saldo_start')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('sum_salary')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('sum_refuelings')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('sum_routes')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('sum_services')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('sum_accrual')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('sum_amount')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Decimal::make('saldo_end')
                ->unit('unit', ['руб.'])->unitDefault(0)
                ->translatable('moonshine::ui.field')->sortable(),
            Text::make('comment')->translatable('moonshine::ui.field'),
            Date::make('created_at')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
            Date::make('updated_at')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }

    protected function filters(): iterable
    {
        return [
            BelongsTo::make(
                'driver',
                'driver',
                formatted: 'profile.SurnameInitials',
                resource: UserResource::class
            )->nullable()
                ->searchable()
                ->translatable('moonshine::ui.field'),

        ];
    }

    protected function search(): array
    {
        return [
            'date',
            'title',
            'driver.profile.SurnameInitials',
            'saldo_start',
            'sum_salary',
            'sum_refuelings',
            'sum_routes',
            'sum_services',
            'sum_accrual',
            'sum_amount',
            'saldo_end',
            'comment'
        ];
    }
}
