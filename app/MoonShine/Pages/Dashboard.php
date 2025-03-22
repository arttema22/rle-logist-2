<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Refilling;
use App\Models\Stat\StatSalaries;
use MoonShine\UI\Components\Collapse;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Pages\Page;
use App\Models\Stat\StatRefilling;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\CardsBuilder;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\CrudResource;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\Core\CrudResourceContract;
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\UI\Components\Heading;

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return __('moonshine::ui.title.dashboard');
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $count_refillings = StatRefilling::
            //orderByDesc('date_from')
            get(['date_from', 'count_refillings'])
            ->pluck('count_refillings', 'date_from')
            //->sortByDesc('date_from')
            ->toArray();
        $count_salaries = StatSalaries::get(['date_from', 'count_salaries'])
            ->pluck('count_salaries', 'date_from')
            ->toArray();

        $sum_refillings = StatRefilling::
            //orderByDesc('date_from')
            get(['date_from', 'sum_refillings'])
            ->pluck('sum_refillings', 'date_from')
            //->sortByDesc('date_from')
            ->toArray();

        //  dd($arr);

        return [
            Collapse::make(
                'refillings',
                [
                    Heading::make('Количество по месяцам')->h(1),
                    LineChartMetric::make('count')
                        ->line(
                            [__('moonshine::ui.title.refillings') => $count_refillings],
                            // '#EC4176',
                            type: 'line'
                        )
                        ->line(
                            [__('moonshine::ui.title.salaries') => $count_salaries],
                            '#EC4176',
                            type: 'line'
                        )
                        ->translatable('moonshine::ui.title')
                    //->withoutSortKeys()
                    //->columnSpan(6),
                ]
            )
                ->translatable('moonshine::ui.title'),

            Collapse::make(
                'refillings',
                [
                    Heading::make('Сумма по месяцам')->h(1),
                    LineChartMetric::make('refillings')
                        ->line(
                            [__('moonshine::ui.title.sum') => $sum_refillings],
                            // '#EC4176',
                            type: 'line'
                        )
                        ->translatable('moonshine::ui.title')
                    //->withoutSortKeys()
                    //->columnSpan(6)
                ]
            )
                ->translatable('moonshine::ui.title'),
        ];
    }
}
