<?php
/**
 * @package     Cahayana\Databases - DatabasesServiceProvider
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Databases;

use Illuminate\Support\ServiceProvider;

class DatabasesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('cahayana.databases', function () {
            return new Databases();
        });

        $this->app->alias('cahayana.databases',Databases::class);
    }
}
