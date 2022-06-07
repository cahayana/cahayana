<?php
/**
 * @package     Cahayana\Databases - Databases
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Databases\Traits;

use Cahayana\Redis\Redis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait Databases
{
    protected ?string $db_connection = null;

    /**
     * manual load connection db
     *
     * @param string $connection
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function connection(string $connection = 'default'): \Illuminate\Database\ConnectionInterface
    {
        $connection = $connection == 'default' ? (!is_null($this->db_connection) ? $this->db_connection : config('database.default')) : $connection;

        return DB::connection($connection);
    }

    /**
     * manual load table w/o model
     *
     * @param string $table_name
     * @param string $connection
     * @return \Illuminate\Database\Query\Builder
     */
    public function table(string $table_name, string $connection = 'default'): \Illuminate\Database\Query\Builder
    {
        $connection = $connection == 'default' ? (!is_null($this->db_connection) ? $this->db_connection : config('database.default')) : $connection;

        return $this->connection($connection)->table($table_name);
    }

    /**
     * manual insert table w/o model
     *
     * @param string $table_name
     * @param array $insert_data
     * @param string $connection
     * @return bool
     */
    public function insert_table(string $table_name, array $insert_data = [], string $connection = 'default'): bool
    {
        if (is_array($insert_data) && count($insert_data) > 0)
        {
            return $this->table($table_name,$connection)->insert($insert_data);
        }
        else
        {
            return false;
        }
    }

    /**
     * manual insert table w/o model and return insert id
     *
     * @param string $table_name
     * @param array $insert_data
     * @param string $connection
     * @return int
     */
    public function insert_return_id_table(string $table_name, array $insert_data = array(), string $connection = 'default', string $custom_id_field = null): int
    {
        if (is_array($insert_data) && count($insert_data) > 0)
        {
            return $this->table($table_name,$connection)->insertGetId($insert_data,$custom_id_field);
        }
        else
        {
            return 0;
        }
    }

    /**
     * manual update table w/o model
     *
     * @param string $table_name
     * @param array $where
     * @param array $update_data
     * @param string $connection
     * @return int
     */
    public function update_table(string $table_name, array $where, array $update_data = [], string $connection = 'default'): int
    {
        if (!is_array($where))
        {
            return 0;
        }

        if (is_array($update_data) && count($update_data) > 0)
        {
            return $this->table($table_name,$connection)->where($where)->update($update_data);
        }
        else
        {
            return 0;
        }
    }

    /**
     * manual delete table w/o model
     *
     * @param string $table_name
     * @param array $where
     * @param string $connection
     * @return int
     */
    public function delete_table(string $table_name, array $where, string $connection = 'default'): int
    {
        if (!is_array($where))
        {
            return 0;
        }

        return $this->table($table_name,$connection)->where($where)->delete();
    }

    /**
     * check database has table or not
     *
     * @param string $table_name
     * @param string $connection (optional connection)
     * @return bool
     */
    public function has_table(string $table_name, string $connection = 'default'): bool
    {
        $connection = $connection == 'default' ? (!is_null($this->db_connection) ? $this->db_connection : config('database.default')) : $connection;

        return Schema::connection($connection)->hasTable($table_name);
    }

    /**
     * for execute raw query
     *
     * @param string $query
     * @param string $connection
     * @return \Illuminate\Support\Collection
     */
    public function query(string $query, string $connection = 'default'): \Illuminate\Support\Collection
    {
        $connection = $connection == 'default' ? (!is_null($this->db_connection) ? $this->db_connection : config('database.default')) : $connection;

        return collect($this->connection($connection)->select($query));
    }

    /**
     * @param string $query
     * @return \Illuminate\Database\Query\Expression
     */
    public function raw(string $query): \Illuminate\Database\Query\Expression
    {
        return DB::raw($query);
    }

    /**
     * force group by statement
     *
     * @param string $connection
     * @return bool
     */
    public function mysql_force_group_by(string $connection = 'default')
    {
        $connection = $connection == 'default' ? (!is_null($this->db_connection) ? $this->db_connection : config('database.default')) : $connection;

        return $this->connection($connection)->unprepared('SET sql_mode=(SELECT REPLACE(@@sql_mode, \'ONLY_FULL_GROUP_BY\', \'\'));');
    }

    /**
     * load repository redis
     *
     * @return Redis
     */
    public function redis()
    {
        return (new Redis());
    }
}
