<?php

namespace App\Providers;

use App\Interfaces\HotelsDataInterface;
use App\Services\BestHotelsDataAdapter;
use App\Services\TopHotelsDataAdapter;
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
      /*  $this->app->singleton(HotelsDataInterface::class, function ($app) {
            switch ($app->make('config')->get('services.stock-checker')) {
                case 'tophotels':
                    return new TopHotelsDataAdapter();
                case 'besthotels':
                    return new BestHotelsDataAdapter();
                default:
                    throw new \RuntimeException("Unknown hotel provider data");
            }
        });*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
