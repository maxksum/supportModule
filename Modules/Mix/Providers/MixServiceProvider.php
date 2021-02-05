<?php

namespace Modules\Mix\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Cache, JavaScript;

class MixServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->commands([
          \Modules\Mix\Console\MixesHandler::class,
          \Modules\Mix\Console\MixLogsHandler::class,
		  \Modules\Mix\Console\LobbiesHandler::class,
        ]);

        view()->composer('core::home', function ($view) {
          if (Cache::has('CurrentLobbies')) {
            $lobbies = Cache::get("CurrentLobbies");
          } else {
            $lobbies = [];
          }
          JavaScript::put([
            'lobbies' => $lobbies
          ]);
          return $view;
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('mix.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'mix'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/mix');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/mix';
        }, \Config::get('view.paths')), [$sourcePath]), 'mix');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/mix');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'mix');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'mix');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
