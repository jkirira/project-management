<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\IssueInterface', 'App\Repositories\IssueRepository');
        $this->app->bind('App\Interfaces\TenantInterface', 'App\Repositories\TenantRepository');
        $this->app->bind('App\Interfaces\UnitInterface', 'App\Repositories\UnitRepository');
        $this->app->bind('App\Interfaces\ManagerInterface', 'App\Repositories\ManagerRepository');
        $this->app->bind('App\Interfaces\ProjectInterface', 'App\Repositories\ProjectRepository');
        $this->app->bind('App\Interfaces\FinancialHistoryInterface', 'App\Repositories\FinancialHistoryRepository');
        $this->app->bind('App\Interfaces\UserInterface', 'App\Repositories\UserRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
