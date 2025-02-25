<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\RealtimeProfit;

use Throwable;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\UI\Components\CardsBuilder;
use App\MoonShine\Resources\SalaryResource;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\RefillingResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

class RealtimeProfitIndexPage extends IndexPage
{

    protected function fields(): iterable
    {
        return [
            Text::make('name', 'profile.SurnameInitials')->translatable('moonshine::ui.field')->sortable(),
            HasMany::make(
                'salaries',
                'salaries',
                resource: SalaryResource::class
            )->fields([
                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                Text::make('salary'),
                Text::make('comment'),
            ]),
            // HasMany::make(
            //     'refillings',
            //     'refillings',
            //     resource: RefillingResource::class
            // )->fields([
            //     Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
            //     Text::make('cost_car_refueling'),
            //     Text::make('comment'),
            // ]),
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
