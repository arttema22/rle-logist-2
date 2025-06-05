<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Pages\TestPage;
use App\MoonShine\Pages\LoginPage;
use App\MoonShine\Pages\ForgotPage;
use App\MoonShine\Pages\ProfilePage;
use Illuminate\Support\ServiceProvider;
use App\MoonShine\Pages\ResetPasswordPage;
use App\MoonShine\Resources\ProfitResource;
use App\MoonShine\Resources\SalaryResource;
use App\MoonShine\Resources\ProfileResource;
use App\MoonShine\Resources\RefillingResource;
use App\MoonShine\Resources\Setup\UserResource;
use App\MoonShine\Resources\Setup\TruckResource;
use App\MoonShine\Resources\Dir\DirCargoResource;
use App\MoonShine\Resources\Dir\DirPayerResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\RealtimeProfitResource;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use App\MoonShine\Resources\Setup\SetupRouteResource;
use App\MoonShine\Resources\SetupIntegrationResource;
use App\MoonShine\Resources\Dir\DirTruckBrandResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\Setup\SetupTariffResource;
use App\MoonShine\Resources\Setup\SetupServiceResource;
use App\MoonShine\Resources\Driver\DriverSalaryResource;
use App\MoonShine\Resources\Dir\DirPetrolStationResource;
use App\MoonShine\Resources\RouteResource;
use App\MoonShine\Resources\Setup\SetupTypeTruckResource;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;

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
                RealtimeProfitResource::class,

                SalaryResource::class,
                RefillingResource::class,
                RouteResource::class,
                ProfitResource::class,

                // Setup
                SetupServiceResource::class,
                SetupTypeTruckResource::class,
                UserResource::class,
                TruckResource::class,
                SetupRouteResource::class,
                SetupTariffResource::class,

                // Dir
                DirPayerResource::class,
                DirCargoResource::class,
                DirPetrolStationResource::class,
                DirTruckBrandResource::class,

                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                ProfileResource::class,
                SetupIntegrationResource::class,
                DriverSalaryResource::class,

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
