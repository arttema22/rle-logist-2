<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Salary;
use MoonShine\Support\ListOf;
use MoonShine\Laravel\Enums\Action;
use Illuminate\Support\Facades\Auth;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Support\Enums\SortDirection;
use App\MoonShine\Pages\Salary\SalaryFormPage;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\Salary\SalaryIndexPage;
use App\MoonShine\Resources\Setup\UserResource;
use App\MoonShine\Pages\Salary\SalaryDetailPage;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;

#[Icon('trophy')]
class SalaryResource extends ModelResource
{

    protected string $model = Salary::class;

    protected bool $withPolicy = true;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.salaries');
    }

    protected ?string $alias = 'salaries';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    protected bool $columnSelection = true;

    protected bool $stickyTable = true;

    protected bool $stickyButtons = true;

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(
                Action::MASS_DELETE,
                Action::VIEW
            );
    }

    protected string $sortColumn = 'date';

    protected SortDirection $sortDirection = SortDirection::DESC;

    protected function pages(): array
    {
        return [
            SalaryIndexPage::class,
            SalaryFormPage::class,
            SalaryDetailPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'date' => ['required', 'date', 'before_or_equal:today'],
            'salary' => ['required', 'decimal:0,2', 'min:10', 'max:9999999.99'],
        ];
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
        return ['date', 'salary', 'comment'];
    }

    protected function queryTags(): array
    {
        return [
            QueryTag::make(
                __('moonshine::ui.button.active'),
                fn(Builder $query) => $query->where('profit_id',  0)
            )->alias('active')
                ->default(),
            QueryTag::make(
                __('moonshine::ui.button.archive'),
                fn(Builder $query) => $query->whereNot('profit_id', 0)
            )->alias('archive'),
        ];
    }

    protected function beforeCreating(mixed $item): mixed
    {
        $item->owner_id = Auth::user()->id;
        return $item;
    }

    protected function metrics(): array
    {
        return [
            ValueMetric::make('salaries')
                ->value(Salary::where('profit_id',  0)->count())
                ->columnSpan(2, 4)
                ->translatable('moonshine::ui.title'),

            ValueMetric::make('archive')
                ->value(Salary::whereNot('profit_id',  0)->count())
                ->columnSpan(2, 4)
                ->translatable('moonshine::ui.button'),

        ];
    }
}
