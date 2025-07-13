<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Download;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $nouvellesDemandes = Download::where('status', 'en_attente')->count();
            $view->with('nouvellesDemandes', $nouvellesDemandes);
        });
    }
}
