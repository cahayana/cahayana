<?php
/**
 * @package     Helpers - Encryption Helpers
 * @author      singkek
 * @copyright   Copyright(c) 2019
 * @version     1
 **/

use Cahayana\Encryption\Aes\Aes;

if ( ! function_exists('aes_encrypt'))
{
    /**
     * aes encrypt
     *
     * for encrypt string
     *
     * @param string $string
     * @param bool $custom_key
     * @param null $key
     * @return string
     */
    function aes_encrypt(string $string, bool $custom_key = false, $key = null)
    {
        if (!$custom_key && !!is_null($key))
        {
            Aes::setKey(config('cahayana.encrypt_key'));
        }
        else if (!!$custom_key && !is_null($key))
        {
            Aes::setKey($key);
        }

        return Aes::enkrip($string);
    }
}

if ( ! function_exists('aes_decrypt'))
{
    /**
     * aes decrypt
     *
     * for decrypt string from aec encryption
     *
     * @param string $string
     * @param bool $custom_key
     * @param null $key
     * @return string
     */
    function aes_decrypt(string $string, bool $custom_key = false, $key = null)
    {
        if (!$custom_key && !!is_null($key))
        {
            Aes::setKey(config('cahayana.encrypt_key'));
        }
        else if (!!$custom_key && !is_null($key))
        {
            Aes::setKey($key);
        }

        return Aes::dekrip($string);
    }
}
