<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\MoonShine\Filters\AllDateFilter;
use Carbon\Carbon;
use App\Models\User;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Hidden;
use MoonShine\UI\Fields\Textarea;
use Illuminate\Support\Facades\DB;
use MoonShine\UI\Components\Alert;
use MoonShine\Laravel\Enums\Action;
use Illuminate\Support\Facades\Auth;
use MoonShine\UI\Components\Heading;
use MoonShine\Support\Attributes\Icon;
use Illuminate\Database\Eloquent\Model;
use MoonShine\UI\Components\FormBuilder;
use App\MoonShine\Filters\DateUserFilter;
use MoonShine\UI\Components\ActionButton;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\UI\ActionButtonContract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Laravel\Fields\Relationships\HasMany;
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

    protected function modifyQueryBuilder(Builder $builder): Builder
    {
        return $builder
            ->withCount('routes')
            ->withCount('refillings')
            ->withCount('salaries')
            ->withCount('services')
            ->withSum('routes', 'summ_route')
            ->withSum('refillings', 'cost_car_refueling')
            ->withSum('salaries', 'salary')
            ->withSum('services', 'sum')
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

        //dd(Builder $q);
        //$date = '2023-10-01'; // Укажите нужную дату
        // $formattedDate = Carbon::createFromFormat('Y-m-d', '2024-02-01');

        // $salaries = DB::table('salaries')->where('date', '<=', $formattedDate)->get();
        // dd($salaries);

        return [
            // new AllDateFilter(),
            // Date::make('date')->onApply(
            //     fn(Builder $q) =>
            //     $q->dd() //whereExists($salaries)->dd()
            //  $q->where()
            //            ),
            //Date::make('test', 'salaries.date'),
            // HasMany::make('salaries', 'salaries', resource: SalaryResource::class)
            //     ->fields([
            //         Date::make('test', 'date'),
            //     ]),

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
