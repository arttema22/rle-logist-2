<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Closure;
use App\Models\Refilling;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Components\Alert;
use MoonShine\Laravel\Enums\Action;
use Illuminate\Support\Facades\Auth;
use MoonShine\Support\Attributes\Icon;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Laravel\Components\Fragment;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\Refilling\RefillingFormPage;
use App\MoonShine\Pages\Refilling\RefillingIndexPage;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use App\MoonShine\Pages\Refilling\RefillingDetailPage;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;
use App\MoonShine\Resources\Dir\DirPetrolStationResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;

#[Icon('trophy')]
class RefillingResource extends ModelResource
{
    protected string $model = Refilling::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.refillings');
    }

    protected ?string $alias = 'refillings';

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
                Action::MASS_DELETE
            );
    }

    protected string $sortColumn = 'date';
    protected SortDirection $sortDirection = SortDirection::DESC;

    protected function pages(): array
    {
        return [
            RefillingIndexPage::class,
            RefillingFormPage::class,
            RefillingDetailPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'date' => ['required', 'date', 'before_or_equal:today'],
            'owner_id' => ['required'],
            'driver_id' => ['required'],
            'petrol_stations_id' => ['required'],
            'num_liters_car_refueling' => ['required'],
            'price_car_refueling' => ['required'],
            'cost_car_refueling' => ['required'],
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
        return [
            'date',
            'driver.profile.SurnameInitials',
            'petrolStation.title',
            'num_liters_car_refueling',
            'price_car_refueling',
            'cost_car_refueling',
            'comment'
        ];
    }

    protected function queryTags(): array
    {
        return [
            QueryTag::make(
                __('moonshine::ui.button.active'),
                fn(Builder $query) => $query->where('profit_id', '=', 0)
            )->alias('active')
                ->default(),
            QueryTag::make(
                __('moonshine::ui.button.archive'),
                fn(Builder $query) => $query->where('profit_id', '!=', 0)
            )->alias('archive'),
        ];
    }

    protected function beforeCreating(mixed $item): mixed
    {
        $item->owner_id = Auth::user()->id;
        $item->price_car_refueling = env('PRICE_CAR_REFUELING');
        $item->cost_car_refueling = request('num_liters_car_refueling') * env('PRICE_CAR_REFUELING');
        return $item;
    }

    protected function beforeUpdating(mixed $item): mixed
    {
        $item->owner_id = Auth::user()->id;
        $item->price_car_refueling = env('PRICE_CAR_REFUELING');
        $item->cost_car_refueling = request('num_liters_car_refueling') * env('PRICE_CAR_REFUELING');
        return $item;
    }

    // protected function trAttributes(): Closure
    // {
    //     return function (?DataWrapperContract $data, int $row) {
    //         if ($data != null) {
    //             $data = $data->toArray();
    //             if ($data['price_car_refueling'] != env('PRICE_CAR_REFUELING'))
    //                 return [
    //                     'class' => 'bgc-red',
    //                 ];
    //             if ($data['integration_id'] == 0)
    //                 return [
    //                     'class' => 'bgc-blue',
    //                 ];
    //         }
    //     };
    // }

    protected function metrics(): array
    {
        return [
            ValueMetric::make('refillings')
                ->value(fn() => Refilling::count())
                ->columnSpan(2, 4)
                ->translatable('moonshine::ui.title'),

            ValueMetric::make('handmade')
                ->value(fn() => Refilling::whereIntegrationId(0)->count())
                ->progress(fn(): int => REfilling::count())
                ->class('bgc-blue')
                ->columnSpan(2, 4)
                ->translatable('moonshine::ui.title'),

            ValueMetric::make('auto')
                ->value(fn() => Refilling::whereNot('integration_id', 0)->count())
                ->progress(fn(): int => REfilling::count())
                ->columnSpan(2, 4)
                ->translatable('moonshine::ui.title'),

            ValueMetric::make('diesel')
                ->value(fn() => Refilling::where('type_fuel', Refilling::TYPE_DIESEL)
                    ->count())
                ->progress(fn(): int => REfilling::count())
                ->columnSpan(2, 4)
                ->translatable('moonshine::ui.title'),

            ValueMetric::make('benzine')
                ->value(fn() => Refilling::where('type_fuel', Refilling::TYPE_BENZINE)
                    ->count())
                ->progress(fn(): int => REfilling::count())
                ->class('bgc-red')
                ->columnSpan(2, 4)
                ->translatable('moonshine::ui.title'),
        ];
    }
}
