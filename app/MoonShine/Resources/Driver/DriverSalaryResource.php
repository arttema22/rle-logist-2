<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Driver;

use App\Models\Salary;
use App\MoonShine\Layouts\DriverLayout;
use MoonShine\Laravel\Pages\Page;
use App\Models\Driver\DriverSalary;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Laravel\Resources\ModelResource;

use App\MoonShine\Pages\DriverSalary\DriverSalaryFormPage;
use App\MoonShine\Pages\DriverSalary\DriverSalaryIndexPage;
use App\MoonShine\Pages\DriverSalary\DriverSalaryDetailPage;

/**
 * @extends ModelResource<DriverSalary, DriverSalaryIndexPage, DriverSalaryFormPage, DriverSalaryDetailPage>
 */
class DriverSalaryResource extends ModelResource
{
    protected ?string $layout = DriverLayout::class;

    protected string $model = Salary::class;

    protected string $title = 'Driver/DriverSalaries';

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
     * @param DriverSalary $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
