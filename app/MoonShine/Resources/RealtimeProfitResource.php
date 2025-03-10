<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\User;
use App\Models\RealtimeProfit;
use MoonShine\Support\AlpineJs;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\Support\Attributes\Icon;
use MoonShine\UI\Components\CardsBuilder;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitFormPage;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitIndexPage;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitDetailPage;

#[Icon('trophy')]
class RealtimeProfitResource extends ModelResource
{
    protected string $model = User::class;

    protected array $with = ['profile'];

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

    protected string $title = 'RealtimeProfits';

    public function getListEventName(?string $name = null, array $params = []): string
    {
        $name ??= $this->getListComponentName();

        return AlpineJs::event(JsEvent::CARDS_UPDATED, $name, $params);
    }

    public function modifyListComponent(ComponentContract $component): ComponentContract
    {
        return CardsBuilder::make($this->getItems(), $this->getIndexFields())
            ->cast($this->getCaster())
            ->name($this->getListComponentName())
            ->async()
            //->overlay()
            ->title('profile.SurnameInitials')
            ->subtitle('email')
            //->url(fn($user) => $this->getFormPageUrl($user->getKey()))
            //->thumbnail(fn($user) => asset($user->avatar))
            ->buttons($this->getIndexButtons());
    }

    protected function pages(): array
    {
        return [
            RealtimeProfitIndexPage::class,
            RealtimeProfitFormPage::class,
            RealtimeProfitDetailPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [];
    }
}
