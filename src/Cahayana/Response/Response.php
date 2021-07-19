<?php
/**
 * @package     Cahayana\Response - Response
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Response;

use Illuminate\Support\Carbon;

class Response
{
    /**
     * @param mixed $data
     * @param array $headers
     * @param int $http_code
     * @param bool $gzip
     * @param bool $raw
     * @param bool $pretty
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function api($data = NULL, array $headers = [], int $http_code = 200, bool $gzip = false, bool $raw = false, bool $pretty = false)
    {
        $debug = request()->header('debug') ?? false;

        if ($http_code == 200 || $http_code == NULL)
        {
            $http_code = 200;

            $data = is_array($data) || is_object($data) ? $data : array('message'=>$data);

            $response = [
                'success'       => true,
                'response_code' => $http_code != NULL ? $http_code : 200,
                'data'          => $data
            ];

            if (!!$debug)
            {
                /*
                 * generate execute time
                 */
                $execute_time = (microtime(true)-LARAVEL_START);

                $response['debug'] = [
                    'request' => [
                        'all' => request()->all(),
                        'post' => request()->method() != 'GET' ? request()->post() : [],
                        'get' => request()->query(),
                    ],
                    'statistics' => [
                        'method' => request()->method(),
                        'execute_time' => $execute_time,
                        'client_ip' => request()->ip(),
                        'reqeust_at' => gmdate('D, d M Y H:i:s T', time())
                    ],
                    'response_headers' => $headers,
                    'request_headers' => request()->header()
                ];
            }

            if(!!$raw)
            {
                $response = $data;
            }

            if (!!$gzip)
            {
                /*
                 * set env response
                 */
                $offset = 60 * 60;
                $expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";

                if(is_array($response) || is_object($response))
                {
                    $response = gzencode(json_encode($response),9);
                }
                else
                {
                    $response = gzencode($response,9);
                }

                return response($response)->setStatusCode($http_code != NULL ? $http_code : 200)->withHeaders([
                    'Access-Control-Allow-Origin' => '*',
                    'Access-Control-Allow-Methods' => request()->getMethod(),
                    'Content-type' => 'application/json; charset=utf-8',
                    'Cache-Control' => 'private, no-cache, no-store, must-revalidate',
                    'Content-Length' => strlen($response),
                    'Content-Encoding' => 'gzip',
                    'Vary' => 'Accept-Encoding',
                    'Pragma' => 'no-cache',
                    'expires' => $expire,
                ]);
            }

        }
        else{
            $response = [
                'success'=>false,
                'response_code' => $http_code,
                'error' => [
                    'error_code' => $http_code,
                    'error_message' => $data
                ]
            ];

            if (!!$debug)
            {
                $response['debug'] = [
                    'query' => request()->all(),
                    'header' => request()->header()
                ];
            }

            if(!!$raw)
            {
                $response = $data;
            }

            if (!!$gzip)
            {
                /*
                 * set env response
                 */
                $offset = 60 * 60;
                $expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";

                if(is_array($response) || is_object($response))
                {
                    $response = gzencode(json_encode($response),9);
                }
                else
                {
                    $response = gzencode($response,9);
                }

                return response($response)->setStatusCode($http_code != NULL ? $http_code : 500)->withHeaders([
                    'Access-Control-Allow-Origin' => '*',
                    'Access-Control-Allow-Methods' => request()->getMethod(),
                    'Content-type' => 'application/json; charset=utf-8',
                    'Cache-Control' => 'private, no-cache, no-store, must-revalidate',
                    'Content-Length' => strlen($response),
                    'Content-Encoding' => 'gzip',
                    'Vary' => 'Accept-Encoding',
                    'Pragma' => 'no-cache',
                    'expires' => $expire,
                ]);
            }

        }

        if(!!$pretty)
        {
            return response()->json($response,$http_code,$headers,JSON_PRETTY_PRINT);
        }
        else
        {
            return response()->json($response,$http_code,$headers);
        }
    }

    /**
     * @param mixed $data
     * @param array $headers
     * @param int $http_code
     * @param bool $raw
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function gzip($data = NULL, array $headers = [], int $http_code = 200, bool $raw = false)
    {
        return self::api($data, $headers, $http_code,true,$raw);
    }
}
