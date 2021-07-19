<?php
/**
 * @package     Cahayana\Support\Facade - Response
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Support\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static api($data, array $headers = [], int $http_code = 200, bool $gzip = false, bool $raw = false, bool $pretty = false) returning response api
 * @method static gzip($data, array $headers = [], int $http_code = 200, bool $raw = false) returning response api gzip
 * @see \Cahayana\Response\Response
 * @mixin \Cahayana\Response\Response
 */
class Response extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'cahayana.response';
    }
}
