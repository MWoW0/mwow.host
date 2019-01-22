<?php

namespace Sasin91\TrinitycoreCompiler;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Sasin91\TrinitycoreCompiler\Http\Controllers\RunDeployScript;
use Sasin91\TrinitycoreCompiler\Http\Middleware\Authorize;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'trinitycore-compiler');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            //
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/trinitycore-compiler')
                ->group(__DIR__.'/../routes/api.php');

        Route::middleware(['nova', Authorize::class])->get('/deploy', 'Sasin91\TrinitycoreCompiler\Http\Controllers\RunDeployScript');
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
