<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Route;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Date;
use MoonShine\Laravel\Enums\Action;
use Illuminate\Support\Facades\Auth;
use MoonShine\Support\Attributes\Icon;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Laravel\QueryTags\QueryTag;
use App\MoonShine\Pages\Route\RouteFormPage;
use App\MoonShine\Pages\Route\RouteIndexPage;
use App\MoonShine\Pages\Route\RouteDetailPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

#[Icon('trophy')]
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
                Action::MASS_DELETE
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
        return $item;
    }
}
