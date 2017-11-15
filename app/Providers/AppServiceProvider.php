<?php

namespace App\Providers;

use App\Models\City;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->runningInConsole()) {
            $this->app->singleton('region', function($app) {
                return ($id = $app['request']->cookie('region-selected')) ? City::query()->find($id) : null;
            });

//            if ($this->app->bound('debugbar')) {
//                /** @var DebugBar $debugbar */
//                $debugbar = $this->app['debugbar'];
//                $debugbar->addCollector(new MessagesCollector('api_requests'));
//            }
        }
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
