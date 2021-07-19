<?php
/**
 * @package     Cahayana\Config - ConfigServiceProvider
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Config;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class ConfigServiceProvider extends LaravelServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $source = __DIR__ . '/config.php';

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('cahayana.php')], 'cahayana-config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('cahayana');
        }

        $this->mergeConfigFrom($source, 'cahayana');
    }
}
