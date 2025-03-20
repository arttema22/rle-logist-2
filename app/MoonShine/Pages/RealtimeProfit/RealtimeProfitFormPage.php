<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\RealtimeProfit;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use App\MoonShine\Resources\SalaryResource;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\RefillingResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

class RealtimeProfitFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            HasMany::make(
                'salaries',
                'salaries',
                resource: SalaryResource::class
            )->fields([
                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                Text::make('salary'),
                Text::make('comment'),
            ])->relatedLink(),
            HasMany::make(
                'refillings',
                'refillings',
                resource: RefillingResource::class
            )->fields([
                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                Text::make('cost_car_refueling'),
                Text::make('comment'),
            ])->relatedLink(),
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
