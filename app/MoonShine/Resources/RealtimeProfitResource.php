<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\User;
use App\Models\RealtimeProfit;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitFormPage;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitIndexPage;
use App\MoonShine\Pages\RealtimeProfit\RealtimeProfitDetailPage;

#[Icon('trophy')]
class RealtimeProfitResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'RealtimeProfits';

    /**
     * @return list<Page>
     */
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
