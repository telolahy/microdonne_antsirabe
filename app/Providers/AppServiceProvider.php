<?php

namespace App\Providers;

use App\Download;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::defaultView('pagination::bootstrap-4');
        Paginator::defaultSimpleView('pagination::simple-bootstrap-4');
        View::composer('*', function ($view) {
            $nouvellesDemandes = Download::where('status', 'en_attente')->count();
            $view->with('nouvellesDemandes', $nouvellesDemandes);
        });
    }
}
