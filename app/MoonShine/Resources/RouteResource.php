<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Route;
use App\Models\RouteBilling;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Date;
use App\Models\Dir\DirTypeTruck;
use MoonShine\Laravel\Enums\Action;
use Illuminate\Support\Facades\Auth;
use MoonShine\Support\Attributes\Icon;
use App\MoonShine\Pages\Route\RouteFormPage;
use App\MoonShine\Pages\Route\RouteIndexPage;
use App\MoonShine\Pages\Route\RouteDetailPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

#[Icon('arrow-path-rounded-square')]
class RouteResource extends ModelResource
{
    protected string $model = Route::class;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.routes');
    }

    protected ?string $alias = 'routes';

    // protected bool $createInModal = true;

    // protected bool $editInModal = true;

    //protected bool $detailInModal = true;

    protected bool $columnSelection = true;

    protected bool $stickyTable = true;

    protected bool $stickyButtons = true;

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(
                Action::MASS_DELETE,
                //Action::CREATE,
                //  Action::VIEW,
                //Action::UPDATE,
                //Action::DELETE
            );
    }

    protected function pages(): array
    {
        return [
            RouteIndexPage::class,
            RouteFormPage::class,
            RouteDetailPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'date' => ['required', 'date', 'before_or_equal:today'],
            'dir_type_trucks_id' => ['required'],
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
            Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
        ];
    }

    protected function search(): array
    {
        return [
            'date',
            'driver.profile.SurnameInitials',
            'typeTruck.title',
            'cargo.title',
            'payer.title',
            'address_loading',
            'address_unloading',
            'route_length',
            'price_route',
            'number_trips',
            'unexpected_expenses',
            'summ_route',
            'comment'
        ];
    }

    // protected function queryTags(): array
    // {
    //     return [
    //         QueryTag::make(
    //             __('moonshine::ui.button.active'),
    //             fn(Builder $query) => $query->where('profit_id', '=', 0)
    //         )->alias('active')
    //             ->default(),
    //         QueryTag::make(
    //             __('moonshine::ui.button.archive'),
    //             fn(Builder $query) => $query->where('profit_id', '!=', 0)
    //         )->alias('archive'),
    //     ];
    // }

    protected bool $isAsync = false;

    protected function beforeCreating(mixed $item): mixed
    {
        $routeBilling = RouteBilling::find(request()->input('route'));
        $val_type_truck = request()->input('dir_type_trucks_id');
        request()->request->remove('route');

        // dd(request()->request);

        // dd($val_type_truck);

        $routeBilling->is_static ? $route_length = 0 : $route_length = $routeBilling->length;

        // расчет цены маршрута
        if ($routeBilling->is_static) {
            $price_route = $routeBilling->price;
        } else {
            $length = $routeBilling->length;
            $tariff = DirTypeTruck::find($val_type_truck)->tariffs()
                ->where('start', '<=', $length)
                ->where('end', '>=', $length)->first();
            $tariff->type_calculation ? $price_route = $tariff->price * $length
                : $price_route = $tariff->price;
        }

        $price_route = $price_route * request()->input('number_trips');

        //dd(request()->input('route'));
        //dd($routeBilling);

        request()->merge([
            'address_loading' => $routeBilling->start,
            'address_unloading' => $routeBilling->finish,
            'route_length' => $route_length,
            'price_route' => $price_route,
        ]);

        // $item->owner_id = Auth::user()->id;
        //$item->address_loading = $routeBilling->start;

        // dd(request()->request);

        return $item;
    }
}
