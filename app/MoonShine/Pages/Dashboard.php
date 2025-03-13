<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Refilling;
use App\Models\Stat\StatRefilling;
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Pages\Page;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Laravel\Resources\CrudResource;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\CardsBuilder;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\Core\CrudResourceContract;

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
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $arr = StatRefilling::
            //orderByDesc('date_from')
            all()
            ->pluck('count_refillings', 'date_from')
            ->toArray();

        return [
            LineChartMetric::make('Refillings')
                ->line([
                    'Profit' => StatRefilling::query()

                        ->selectRaw('SUM(count_refillings) as sum, date_from as date')
                        ->groupBy('date')
                        //->orderBy('date')
                        //->orderByDesc('date')
                        ->pluck('sum', 'date')
                        ->toArray()
                ], type: 'line'),

            LineChartMetric::make('Refillings')
                ->line([$arr], '#EC4176', type: 'line')
        ];
    }
}
