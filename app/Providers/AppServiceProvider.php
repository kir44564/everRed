<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;
use App\View\Components\AuthLayout;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureUrl();

        Blade::component('auth-layout', AuthLayout::class);
    }
    
    private function configureCommands()
    {
        DB::prohibitDestructiveCommands(
            app()->environment('production'),
        );
    }

    private function configureModels()
    {
        Model::shouldBeStrict();

        Model::unguard();
    }

    private function configureUrl()
    {
        URL::forceScheme('https');
    }
}
