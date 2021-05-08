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
 * @method static \Illuminate\Database\ConnectionInterface connection(string $connection = 'default') manual load connection db
 * @method static \Illuminate\Database\Query\Builder table(string $table_name, string $connection = 'default') manual load table w/o model
 * @method static boolean insert_table(string $table_name, array $insert_data = [], string $connection = 'default') manual insert table w/o model
 * @method static bool|integer insert_return_id_table(string $table_name, array $insert_data = array(), string $connection = 'default') manual insert table w/o model and return insert id
 * @method static boolean update_table(string $table_name, array $where, array $update_data = [], string $connection = 'default') manual update table w/o model
 * @method static boolean delete_table(string $table_name, array $where, string $connection = 'default') manual delete table w/o model
 * @method static boolean has_table(string $table_name, string $connection = 'default') check database has table or not
 * @method static \Illuminate\Support\Collection query(string $query, string $connection = 'default') for execute raw query
 * @method static \Illuminate\Database\Query\Expression raw(string $query) reference DB:raw() function
 * @method static boolean mysql_force_group_by(string $connection = 'default') force group by statement
 * @method static \Cahayana\Redis\Redis redis() load repository redis
 * @see \Cahayana\Databases\Databases
 * @mixin \Cahayana\Databases\Databases
 */
class Repository extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'cahayana.databases';
    }
}
