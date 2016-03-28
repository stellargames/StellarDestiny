<?php

namespace Stellar\Providers;

use Illuminate\Support\ServiceProvider;
use Stellar\Api\CommandHandler;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Development helpers.
        if ($this->app->environment() === 'local') {
            $this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        }

        // Bind the command handler for the api.
        $this->app->bind('Stellar\Contracts\CommandHandlerInterface', function ($app) {
            $commands = $app['config']['api']['commands'];
            return new CommandHandler($commands);
        });
        $this->app->bind('Stellar\Contracts\NameGeneratorInterface', 'Stellar\Helpers\StarNameGenerator');
        $this->app->bind('Stellar\Repositories\Contracts\StarRepositoryInterface',
          'Stellar\Repositories\Eloquent\StarRepository');
    }
}
