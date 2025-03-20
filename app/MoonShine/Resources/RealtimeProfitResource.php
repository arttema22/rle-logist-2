<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Closure;
use App\Models\User;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\Modal;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Support\Attributes\Icon;
use MoonShine\UI\Components\OffCanvas;
use MoonShine\UI\Collections\TableRows;
use MoonShine\UI\Collections\TableCells;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Table\TableRow;
use MoonShine\Contracts\UI\TableRowContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Table\TableBuilder;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Contracts\UI\Collection\TableRowsContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitFormPage;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitIndexPage;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitDetailPage;

#[Icon('trophy')]
class RealtimeProfitResource extends ModelResource
{

    protected string $model = User::class;

    protected array $with = [
        'profile',
        'routes',
        'refillings',
        'salaries',
        //  'profit',
    ];

    protected string $column = 'profile.SurnameInitials';

    protected bool $columnSelection = true;

    //protected bool $isLazy = true;

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

    // public function query(): Builder
    // {

    //  dd($this->model);
    // if (Auth::user()->moonshine_user_role_id == 3)
    //     return parent::query()
    //         ->where('driver_id', Auth::user()->id)
    //         ->with('driver');

    //  return parent::query()->with('profile');
    // return parent::query();
    // }

    // protected function modifyQueryBuilder(Builder $builder): Builder
    // {
    //     //dd($builder->where('status', true)->toSql());
    //     return $builder->where('status', true)
    //         ->where('role_id', 2)
    //         ->orderByDesc('name');
    // }

    protected function modifyQueryBuilder(Builder $builder): Builder
    {
        return $builder
            ->withCount('routes')
            ->withCount('refillings')
            ->withCount('salaries')
            ->withSum('routes', 'summ_route')
            ->withSum('refillings', 'cost_car_refueling')
            ->withSum('salaries', 'salary')
            // ->with('profit')
        ;
    }

    protected string $title = 'RealtimeProfits';

    // public function getListEventName(?string $name = null, array $params = []): string
    // {
    //     $name ??= $this->getListComponentName();

    //     return AlpineJs::event(JsEvent::CARDS_UPDATED, $name, $params);
    // }

    // public function modifyListComponent(ComponentContract $component): ComponentContract
    // {
    //     return CardsBuilder::make($this->getItems(), $this->getIndexFields())
    //         ->cast($this->getCaster())
    //         ->name($this->getListComponentName())
    //         ->async()
    //         //->overlay()
    //         ->title('profile.SurnameInitials')
    //         ->subtitle('email')
    //         //->url(fn($user) => $this->getFormPageUrl($user->getKey()))
    //         //->thumbnail(fn($user) => asset($user->avatar))
    //         ->buttons($this->getIndexButtons());
    // }

    protected function pages(): array
    {
        return [
            RealtimeProfitIndexPage::class,
            RealtimeProfitFormPage::class,
            RealtimeProfitDetailPage::class,
        ];
    }

    // protected function indexButtons(): ListOf
    // {
    //     return parent::indexButtons()
    //         ->add(ActionButton::make('Link', '/endpoint'));
    // }

    // protected function tdAttributes(): Closure
    // {
    //     return fn(?DataWrapperContract $data, int $row, int $cell) => [
    //         'style' => 'align-content: start'
    //     ];
    // }

    protected function rules(mixed $item): array
    {
        return [];
    }

    // protected function tfoot(): null|TableRowsContract|Closure
    // {
    //     return static function (?TableRowContract $default, TableBuilder $table) {
    //         $cells = TableCells::make();

    //         $cells->pushCell('Balance:');
    //         $cells->pushCell('$1000');

    //         return TableRows::make([TableRow::make($cells), $default]);
    //     };
    // }

    protected function detailButtons(): ListOf
    {
        return parent::detailButtons()
            ->add(
                ActionButton::make('close_period', '/endpoint')->icon('pencil')->primary()
                    ->inOffCanvas(
                        title: fn() => 'Offcanvas Title',
                        content: fn() => 'Content',
                        //name: false,
                        builder: fn(OffCanvas $offCanvas, ActionButton $ctx) => $offCanvas->left(),
                        // опционально - необходимо чтобы компоненты были доступны для поиска в системе, т.к. content всего лишь HTML
                        components: [
                            Date::make(),
                        ],
                    )
            );
    }

    public function test() {}
}
