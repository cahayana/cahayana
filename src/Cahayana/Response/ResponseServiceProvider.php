<?php
/**
 * @package     Cahayana\Redis - RedisServiceProvider
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Response;

use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('cahayana.response', function () {
            return new Response();
        });

        $this->app->alias('cahayana.response',Response::class);
    }
}
