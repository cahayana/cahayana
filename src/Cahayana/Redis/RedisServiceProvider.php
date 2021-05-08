<?php
/**
 * @package     Cahayana\Redis - RedisServiceProvider
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Redis;

use Illuminate\Support\ServiceProvider;

class RedisServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('cahayana.redis', function () {
            return new Redis();
        });

        $this->app->alias('cahayana.redis',Redis::class);
    }
}
