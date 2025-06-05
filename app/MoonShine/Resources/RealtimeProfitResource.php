<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Setup\User;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Hidden;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Support\Enums\Layer;
use MoonShine\UI\Components\Alert;
use MoonShine\Laravel\Enums\Action;
use Illuminate\Support\Facades\Auth;
use MoonShine\UI\Components\Heading;
use MoonShine\Support\Attributes\Icon;
use Illuminate\Database\Eloquent\Model;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\ActionButton;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\UI\ActionButtonContract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitIndexPage;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitDetailPage;

#[Icon('calculator')]
class RealtimeProfitResource extends ModelResource
{

    protected string $model = User::class;

    protected array $with = [
        'profile',
        'routes',
        'refillings',
        'salaries',
        'services',
        'profit',
        'truck',
    ];

    protected string $column = 'profile.SurnameInitials';

    protected bool $columnSelection = true;

    protected bool $isLazy = true;

    protected string $sortColumn = 'name';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(
                Action::MASS_DELETE,
                Action::CREATE,
                //  Action::VIEW,
                Action::UPDATE,
                Action::DELETE
            );
    }

    //protected bool $isAsync = false;

    protected function modifyQueryBuilder(Builder $builder): Builder
    {
        return $builder
            // Отфильтровываем только водителей (без системной записи)
            ->whereNotNull('truck_id');
            //         ->withCount('routes')
            //         ->withCount('refillings')
            //         ->withCount('salaries')
            //         ->withCount('services')
            //         ->withSum('routes', 'summ_route')
            //         ->withSum('refillings', 'cost_car_refueling')
            //         ->withSum('salaries', 'salary')
            //         ->withSum('services', 'sum')
        ;
    }

    public function getTitle(): string
    {
        return __('moonshine::ui.title.realtime_profits');
    }

    protected function pages(): array
    {
        return [
            RealtimeProfitIndexPage::class,
            RealtimeProfitDetailPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }

    // protected bool $isAsync = false;

    protected function filters(): iterable
    {
        $drivers = User::all();

        return [

            Date::make('date')
                ->onApply(
                    function ($query, $value) {
                        // Загружаем связанные данные по условию, но не фильтруем по ним
                        $query->with([
                            'salaries' => fn($q) => $q
                                ->where('profit_id', 0)
                                ->whereDate('date', '<=', $value),
                            'refillings' => fn($q) => $q
                                ->where('profit_id', 0)
                                ->whereDate('date', '<=', $value),
                            'routes' => fn($q) => $q
                                ->where('profit_id', 0)
                                ->whereDate('date', '<=', $value),
                            'services' => fn($q) => $q
                                ->where('profit_id', 0)
                                ->whereDate('date', '<=', $value),
                        ]);
                        return $query;
                    }
                )->translatable('moonshine::ui.field'),
        ];
    }

    protected function modifyDetailButton(ActionButtonContract $button): ActionButtonContract
    {
        return $button->primary();
    }

    // protected function indexButtons(): ListOf
    // {
    //     return parent::indexButtons()
    //         ->prepend(
    //             ActionButton::make(
    //                 'close_period',
    //             )->translatable('moonshine::ui.button')
    //                 ->secondary()
    //         );
    // }

    protected function detailButtons(): ListOf
    {
        return parent::detailButtons()
            ->add(
                ActionButton::make(
                    'close_period',
                )->translatable('moonshine::ui.button')
                    ->secondary()
                    ->inModal(
                        __('moonshine::ui.button.close_period'),
                        fn(Model $item) => FormBuilder::make(route('close.period'))
                            ->fields([
                                Hidden::make('driver_id')->setValue($item->id),
                                Hidden::make('owner_id')->setValue(Auth::user()->id),
                                Alert::make(type: 'error')->content('Внимание! Процедура закрытия периода необратима. Все маршруты, заправки и выплаты попавшие в закрываемый период, не будут доступны для редактирования в дальнейшем.'),
                                Heading::make($item->profile->SurnameInitials),
                                Date::make('date'),
                                Textarea::make('comment')->translatable('moonshine::ui.field'),
                            ])
                            ->async()
                            ->submit(__('moonshine::ui.button.close_period'), ['class' => 'btn-secondary'])
                    ),
                ActionButton::make('back', fn() => $this->getIndexPageUrl())
                    ->translatable('moonshine::ui.button')
            );
    }
}
