<?php

namespace Stellar\Providers;

use Illuminate\Support\ServiceProvider;
use Stellar\Repositories\Eloquent\StarRepository;

class GalaxyServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the galaxy service.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    /**
     * Register the galaxy service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Stellar\Repositories\Contracts\StarRepositoryInterface',
          'Stellar\Repositories\Eloquent\StarRepository');

        $this->app->singleton('galaxy', function ($app) {
            return new StarRepository($app['Stellar\Contracts\NameGeneratorInterface']);
        });
    }
}
