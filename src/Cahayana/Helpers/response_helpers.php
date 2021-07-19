<?php
/**
 * @package     Helpers - Response Helpers
 * @author      singkek
 * @copyright   Copyright(c) 2019
 * @version     1
 **/

use Cahayana\Response\Response;

if ( ! function_exists('response_api'))
{
    /**
     * helper for response api
     *
     * @param mixed $data
     * @param array $headers
     * @param int $http_code
     * @param bool $gzip
     * @param bool $raw
     * @param bool $pretty
     * @return \Illuminate\Http\JsonResponse
     */
    function response_api($data = NULL, array $headers = [], int $http_code = 200, bool $gzip = false, bool $raw = false, bool $pretty = false)
    {
        return (new Response())->api($data,$headers,$http_code,$gzip,$raw,$pretty);
    }
}

if ( ! function_exists('response_gzip'))
{
    /**
     * helper for response gzip
     *
     * @param mixed $data
     * @param array $headers
     * @param int $http_code
     * @param bool $raw
     * @return \Illuminate\Http\JsonResponse
     */
    function response_gzip($data = NULL, array $headers = [], int $http_code = 200, bool $raw = false)
    {
        return (new Response())->gzip($data,$headers,$http_code,$raw);
    }
}
