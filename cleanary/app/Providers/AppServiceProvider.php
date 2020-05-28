<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\PerfumeList;
use App\StarchList;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Schema::defaultStringLength(191);
       
       
       View::composer('*', function ($view)
       {
        $perflists = new PerfumeList();
        $starlists = new StarchList();
           $view->with('perflists',$perflists->List());
       });

       View::composer('*', function ($view)
       {
        
        $starlists = new StarchList();
           $view->with('starlists',$starlists->List());
       });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
