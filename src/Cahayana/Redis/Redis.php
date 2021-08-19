<?php
/**
 * @package     Cahayana\Redis - Redis
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Redis;

use Cahayana\Contracts\Redis\RedisInterface;
use Illuminate\Support\Facades\Redis as LaravelRedis;

class Redis implements RedisInterface
{
    /**
     * set redis db used
     *
     * @param int $db [db number]
     * @return Redis
     */
    public function select_db(int $db)
    {
        LaravelRedis::select($db);

        return $this ;
    }

    /**
     * set redis data permanently and replace if exist old data
     *
     * @param string $key
     * @param string $value
     * @param int|null $expire_in [second]
     * @return boolean
     */
    public function set(string $key, string $value, int $expire_in = null)
    {
        if (is_null($expire_in))
        {
            return !!LaravelRedis::set($key,$value);
        }
        else
        {
            return !!LaravelRedis::set($key,$value,'EX',$expire_in);
        }
    }

    /**
     * set redis data permanently if old data not exist
     *
     * @param string $key
     * @param string $value
     * @param int|null $expire_in [second]
     * @return boolean
     */
    public function set_if_not_exist(string $key, string $value, int $expire_in = null)
    {
        if (is_null($expire_in))
        {
            return !!LaravelRedis::setnx($key,$value);
        }
        else
        {
            return !!LaravelRedis::set($key,$value,'EX',$expire_in, 'NX');
        }
    }

    /**
     * get redis value by key
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return LaravelRedis::get($key);
    }

    /**
     * delete redis data
     *
     * @param string $key
     * @return boolean
     */
    public function delete(string $key)
    {
        return !!LaravelRedis::delete($key);
    }

    /**
     * check redis data is exist or not
     *
     * @param string $key
     * @return boolean
     */
    public function has(string $key)
    {
        return !!LaravelRedis::exists($key);
    }

    /**
     * return the members of a sorted set by index
     *
     * @param string $key
     * @param int $start
     * @param int $stop
     * @return array [array of objects]
     */
    public function z_range(string $key, int $start, int $stop)
    {
        return LaravelRedis::zrange($key, $start, $stop);
    }

    /**
     * create a new sorted set and/or insert new value to sorted set
     *
     * @param string $key
     * @param int $score
     * @param string $member
     * @return array
     */
    public function z_add_nx(string $key, int $score, string $member)
    {
        return LaravelRedis::zadd($key, 'NX', $score, $member);
    }

    /**
     * return the score of a member from sorted set
     *
     * @param string $key
     * @param string $member
     * @return array
     */
    public function z_score(string $key, string $member)
    {
        return LaravelRedis::zscore($key, $member);
    }

    /**
     * return list of member from a set with score filter
     *
     * @param string $key
     * @param string $min
     * @param string $max
     * @return array
     */
    public function z_range_by_score(string $key, string $min, string $max)
    {
        return LaravelRedis::zrangebyscore($key, $min, $max);
    }

    /**
     * remove member from a sorted set
     *
     * @param string $key
     * @param string $member
     * @return boolean
     */
    public function zrem(string $key, string $member)
    {
        return LaravelRedis::zrem($key, $member);
    }

    /**
     * create a new sorted set and/or insert and/or update value to sorted set
     *
     * @param string $key
     * @param float $score
     * @param string $member
     * @return array
     */
    public function z_add_ch(string $key, float $score, string $member)
    {
        return LaravelRedis::zadd($key, 'CH', $score, $member);
    }

    /**
     * return list of member from a set with score filter
     *
     * @param string $key
     * @param string $min
     * @param string $max
     * @return boolean
     */
    public function z_rem_range_by_score(string $key, string $min, string $max)
    {
        return LaravelRedis::zremrangebyscore($key, $min, $max);
    }
}
