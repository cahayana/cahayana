<?php
/**
 * @package     Cahayana\Contracts\Redis - RedisInterface
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Contracts\Redis;

interface RedisInterface
{
    /**
     * set redis db used
     *
     * @param int $db [db number]
     * @return \Cahayana\Redis\Redis
     */
    public function select_db(int $db);

    /**
     * set redis data permanently and replace if exist old data
     *
     * @param string $key
     * @param string $value
     * @param int|null $expire_in [second]
     * @return boolean
     */
    public function set(string $key, string $value, int $expire_in = null);

    /**
     * set redis data permanently if old data not exist
     *
     * @param string $key
     * @param string $value
     * @param int|null $expire_in [second]
     * @return boolean
     */
    public function set_if_not_exist(string $key, string $value, int $expire_in = null);

    /**
     * get redis value by key
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * delete redis data
     *
     * @param string $key
     * @return boolean
     */
    public function delete(string $key);

    /**
     * check redis data is exist or not
     *
     * @param string $key
     * @return boolean
     */
    public function has(string $key);

    /**
     * return the members of a sorted set by index
     *
     * @param string $key
     * @param int $start
     * @param int $stop
     * @return array [array of objects]
     */
    public function z_range(string $key, int $start, int $stop);

    /**
     * create a new sorted set and/or insert new value to sorted set
     *
     * @param string $key
     * @param int $score
     * @param int $member
     * @return array
     */
    public function z_add_nx(string $key, int $score, int $member);

    /**
     * return the score of a member from sorted set
     *
     * @param string $key
     * @param string $member
     * @return array
     */
    public function z_score(string $key, string $member);

    /**
     * return list of member from a set with score filter
     *
     * @param string $key
     * @param string $min
     * @param string $max
     * @return array
     */
    public function z_range_by_score(string $key, string $min, string $max);

    /**
     * remove member from a sorted set
     *
     * @param string $key
     * @param string $member
     * @return boolean
     */
    public function zrem(string $key, string $member);

    /**
     * create a new sorted set and/or insert and/or update value to sorted set
     *
     * @param string $key
     * @param float $score
     * @param string $member
     * @return array
     */
    public function z_add_ch(string $key, float $score, string $member);

    /**
     * return list of member from a set with score filter
     *
     * @param string $key
     * @param string $min
     * @param string $max
     * @return boolean
     */
    public function z_rem_range_by_score(string $key, string $min, string $max);
}
