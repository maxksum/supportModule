<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Modules\Core\Entities\{News};
use Modules\User\Entities\{User};
use JavaScript;
use Config;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
     private $rev;

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

        $this->rev = 279;

        view()->composer('core::layouts.master', function ($view) {
            $notification = News::getNotification();
            $user = User::getMy();
            $counts = app('Modules\Core\Http\Controllers\CoreController')->getCounts();

            JavaScript::put([
              'user' => $user,
              'counts' => $counts,
              'news' => $notification,
              'users_online' => $counts['users_online']
            ]);
            return $view;
        });

        view()->composer('*', function ($view) {
            $data['rev'] = $this->rev;
            JavaScript::put([
              'money_multiplier' => Config::get("core.money_multiplier")
            ]);
            $data['money_multiplier'] = Config::get("core.money_multiplier");
            return $view->with($data);
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
            __DIR__.'/../Config/config.php' => config_path('core.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'core'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/core');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/core';
        }, \Config::get('view.paths')), [$sourcePath]), 'core');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/core');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'core');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'core');
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
