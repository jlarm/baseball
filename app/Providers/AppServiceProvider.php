<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\OrganizationService;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewContract;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OrganizationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict();
        Model::unguard();
        DB::prohibitDestructiveCommands(app()->isProduction());
        Date::use(CarbonImmutable::class);

        $this->registerGlobalViewData();
    }

    private function registerGlobalViewData(): void
    {
        View::composer('*', function (ViewContract $view): void {
            $organizationService = app(OrganizationService::class);

            $view->with([
                'currentOrganization' => $organizationService->current(),
                'organizationName' => $organizationService->name(),
                'organizationLogoUrl' => $organizationService->logoUrl(),
                'hasOrganizationLogo' => $organizationService->hasLogo(),
            ]);
        });
    }
}
