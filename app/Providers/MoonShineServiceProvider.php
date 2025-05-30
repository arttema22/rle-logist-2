<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Pages\TestPage;
use App\MoonShine\Pages\LoginPage;
use App\MoonShine\Pages\ForgotPage;
use App\MoonShine\Pages\ProfilePage;
use Illuminate\Support\ServiceProvider;
use App\MoonShine\Resources\UserResource;
use App\MoonShine\Pages\ResetPasswordPage;
use App\MoonShine\Resources\RouteResource;
use App\MoonShine\Resources\ProfitResource;
use App\MoonShine\Resources\SalaryResource;
use App\MoonShine\Resources\ProfileResource;
use App\MoonShine\Resources\ServiceResource;
use App\MoonShine\Resources\RefillingResource;
use App\MoonShine\Resources\Dir\DirCargoResource;
use App\MoonShine\Resources\Dir\DirPayerResource;
use App\MoonShine\Resources\Dir\DirRouteResource;
use App\MoonShine\Resources\Dir\DirTariffResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\Dir\DirServiceResource;
use App\MoonShine\Resources\RealtimeProfitResource;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use App\MoonShine\Resources\Dir\DirTypeTruckResource;
use App\MoonShine\Resources\SetupIntegrationResource;
use App\MoonShine\Resources\Dir\DirTruckBrandResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\Driver\DriverSalaryResource;
use App\MoonShine\Resources\Dir\DirPetrolStationResource;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use App\MoonShine\Resources\Sys\TruckResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        // $config->authEnable();

        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                DirTypeTruckResource::class,
                DirTariffResource::class,
                DirCargoResource::class,
                DirPayerResource::class,
                DirPetrolStationResource::class,
                DirServiceResource::class,
                DirRouteResource::class,
                SalaryResource::class,
                UserResource::class,
                RefillingResource::class,
                RouteResource::class,
                ServiceResource::class,
                ProfitResource::class,
                RealtimeProfitResource::class,
                ProfileResource::class,
                SetupIntegrationResource::class,
                DriverSalaryResource::class,
                DirTruckBrandResource::class,
                TruckResource::class,
            ])
            ->pages([
                ...$config->getPages(),
                TestPage::class,
                ProfilePage::class,
                LoginPage::class,
                ForgotPage::class,
                ResetPasswordPage::class,
            ])
        ;
    }
}
