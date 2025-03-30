<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Driver;

use App\Models\Salary;
use MoonShine\Support\ListOf;
use MoonShine\Laravel\Pages\Page;
use App\Models\Driver\DriverSalary;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Support\Attributes\Icon;
use App\MoonShine\Layouts\DriverLayout;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Laravel\Resources\ModelResource;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\MoonShine\Pages\DriverSalary\DriverSalaryFormPage;
use App\MoonShine\Pages\DriverSalary\DriverSalaryIndexPage;
use App\MoonShine\Pages\DriverSalary\DriverSalaryDetailPage;
use Illuminate\Support\Facades\Auth;

/**
 * @extends ModelResource<Salary, DriverSalaryIndexPage, DriverSalaryFormPage, DriverSalaryDetailPage>
 */
#[Icon('trophy')]
class DriverSalaryResource extends ModelResource
{
    protected ?string $layout = DriverLayout::class;

    protected string $model = Salary::class;

    protected function modifyQueryBuilder(Builder $builder): Builder
    {
        return $builder
            ->where('driver_id', Auth::user()->id);
    }

    public function getTitle(): string
    {
        return __('moonshine::ui.title.salaries');
    }

    protected bool $columnSelection = true;

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(
                Action::MASS_DELETE
            );
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            DriverSalaryIndexPage::class,
            DriverSalaryFormPage::class,
            DriverSalaryDetailPage::class,
        ];
    }

    /**
     * @param Salary $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'date' => ['required', 'date', 'before_or_equal:today'],
            'salary' => ['required'],
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
                fn(Builder $query) => $query->where('profit_id', '==', 0)
            )->alias('active')
                ->default(),
            QueryTag::make(
                __('moonshine::ui.button.archive'),
                fn(Builder $query) => $query->where('profit_id', '!=', 0)
            )->alias('archive'),
        ];
    }
}
