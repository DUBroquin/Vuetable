<?php

namespace dubroquin\vuetables;

use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;

/**
 * Class vuetablesServiceProvider.
 *
 * @package dubroquin\vuetables;
 * @author  Arjay Angeles <aqangeles@gmail.com>
 */
class VuetablesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/vuetables.php', 'vuetables');

        $this->publishes([
            __DIR__ . '/config/vuetables.php' => config_path('vuetables.php'),
        ], 'vuetables');

        // Publish Vue.js files
        $this->publishes([
            __DIR__.'/resources/' => resource_path('/assets/js/components/commons')
        ], 'vuetables');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->isLumen()) {
            require_once 'fallback.php';
        }

        $this->app->singleton('vuetables.fractal', function () {
            $fractal = new Manager;
            $config  = $this->app['config'];
            $request = $this->app['request'];

            $includesKey = $config->get('vuetables.fractal.includes', 'include');
            if ($request->get($includesKey)) {
                $fractal->parseIncludes($request->get($includesKey));
            }

            $serializer = $config->get('vuetables.fractal.serializer', DataArraySerializer::class);
            $fractal->setSerializer(new $serializer);

            return $fractal;
        });

        $this->app->alias('vuetables', Vuetables::class);
        $this->app->singleton('vuetables', function () {
            return new Vuetables(new Request(app('request')));
        });

        $this->registerAliases();
    }

    /**
     * Check if app uses Lumen.
     *
     * @return bool
     */
    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen');
    }

    /**
     * Create aliases for the dependency.
     */
    protected function registerAliases()
    {
        if (class_exists('Illuminate\Foundation\AliasLoader')) {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Vuetables', \dubroquin\vuetables\Facades\Vuetables::class);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['vuetables', 'vuetables.fractal'];
    }
}
