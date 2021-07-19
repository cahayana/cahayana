<?php
/**
 * @package     Cahayana\Support\Facade - Redis
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Support\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static boolean select_db(int $db) select used db redis
 * @method static boolean set(string $key, string $value, int $expire_in = null) set redis data permanently and replace if exist old data.
 * @method static boolean set_if_not_exist(string $key, string $value, int $expire_in = null) set redis data permanently if old data not exist
 * @method static mixed get(string $key) get redis value by key
 * @method static boolean delete(string $key) delete redis data
 * @method static boolean has(string $key) check redis data is exist or not
 * @method static array z_range(string $key, int $start, int $stop) return the members of a sorted set by index
 * @method static array z_add_nx(string $key, int $score, int $member) create a new sorted set and/or insert new value to sorted set
 * @method static array z_score(string $key, string $member) return the score of a member from sorted set
 * @method static array z_range_by_score(string $key, string $min, string $max) return list of member from a set with score filter
 * @method static boolean zrem(string $key, string $member) remove member from a sorted set
 * @method static array z_add_ch(string $key, float $score, string $member) create a new sorted set and/or insert and/or update value to sorted set
 * @method static boolean z_rem_range_by_score(string $key, string $min, string $max) return list of member from a set with score filter
 * @see \Cahayana\Redis\Redis
 * @mixin \Cahayana\Redis\Redis
 */
class Redis extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'cahayana.redis';
    }
}
