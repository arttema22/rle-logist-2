<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\Driver\DriverSalaryResource;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{
    Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When
};
use MoonShine\MenuManager\MenuItem;
use MoonShine\MenuManager\MenuGroup;
use App\MoonShine\Resources\Dir\DirTypeTruckResource;
use App\MoonShine\Resources\Dir\DirCargoResource;
use App\MoonShine\Resources\Dir\DirPayerResource;
use App\MoonShine\Resources\Dir\DirPetrolStationResource;
use App\MoonShine\Resources\Dir\DirServiceResource;
use App\MoonShine\Resources\Dir\DirRouteResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\SalaryResource;
use App\MoonShine\Resources\UserResource;
use App\MoonShine\Resources\RefillingResource;
use App\MoonShine\Resources\RouteResource;
use App\MoonShine\Resources\ProfitResource;
use App\MoonShine\Resources\RealtimeProfitResource;
use App\MoonShine\Resources\SetupIntegrationResource;
use App\MoonShine\Resources\Dir\DirTruckBrandResource;
use App\MoonShine\Resources\Sys\TruckResource;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function getFaviconComponent(): Favicon
    {
        return parent::getFaviconComponent()->customAssets([
            'apple-touch' => 'favicon_path',
            '32' => 'favicon_path',
            '16' => 'favicon_path',
            'safari-pinned-tab' => 'favicon_path',
            'web-manifest' => 'favicon_path',
        ]);
    }

    protected function menu(): array
    {
        return [
            MenuItem::make('realtime_profits', RealtimeProfitResource::class)->translatable('moonshine::ui.title'),

            MenuGroup::make('logist', [

                MenuItem::make('salaries', SalaryResource::class)->translatable('moonshine::ui.title'),
                MenuItem::make('refillings', RefillingResource::class)->translatable('moonshine::ui.title'),
                MenuItem::make('routes', RouteResource::class)->translatable('moonshine::ui.title'),
                MenuItem::make('profits', ProfitResource::class)->translatable('moonshine::ui.title'),

                MenuGroup::make('directory', [
                    MenuItem::make('drivers', UserResource::class)->translatable('moonshine::ui.title'),
                    MenuItem::make('trucks', TruckResource::class)->translatable('moonshine::ui.title'),
                    MenuItem::make('brandtrucks', DirTruckBrandResource::class)->translatable('moonshine::ui.title'),
                    MenuItem::make('typetrucks', DirTypeTruckResource::class)->translatable('moonshine::ui.title'),
                    MenuItem::make('cargos', DirCargoResource::class)->translatable('moonshine::ui.title'),
                    MenuItem::make('payers', DirPayerResource::class)->translatable('moonshine::ui.title'),
                    MenuItem::make('petrol_stations', DirPetrolStationResource::class)->translatable('moonshine::ui.title'),
                    MenuItem::make('services', DirServiceResource::class)->translatable('moonshine::ui.title'),
                    MenuItem::make('routes', DirRouteResource::class)->translatable('moonshine::ui.title'),
                ])->translatable('moonshine::ui.title')->icon('queue-list'),

            ])->translatable('moonshine::ui.title')->icon('map'),

            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
                MenuItem::make('admins', MoonShineUserResource::class)->translatable('moonshine::ui.title'),
                MenuItem::make(__('moonshine::ui.title.integrations'), SetupIntegrationResource::class),
                // MenuItem::make(
                //     static fn() => __('moonshine::ui.resource.role_title'),
                //     MoonShineUserRoleResource::class
                // ),
            ])->icon('cog-6-tooth'),

            MenuItem::make('salaries', DriverSalaryResource::class)->translatable('moonshine::ui.title'),
            //...parent::menu(),

        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    protected function getFooterCopyright(): string
    {
        return \sprintf(
            <<<'HTML'
                &copy; 2022-%d
                HTML,
            now()->year,
        );
    }

    protected function getFooterMenu(): array
    {
        return [
            //        'https://example.com' => 'Custom link',
        ];
    }

    public function build(): Layout
    {
        return parent::build();
    }
}
