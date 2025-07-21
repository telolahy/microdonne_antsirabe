<?php

namespace App\Providers;

use App\Download;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
        $nouvellesDemandes = 0;

        if (Auth::check()) 
        {
            $directionId = Auth::user()->direction_id;

            $nouvellesDemandes = Download::where('status', 'en_attente')
                ->whereHas('file', function ($query) use ($directionId) {
                    $query->where('direction_id', $directionId);
                })
                ->count();
        }

        $view->with('nouvellesDemandes', $nouvellesDemandes);
    });
    }
}
