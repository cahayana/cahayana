<?php
/**
 * @package     Cahayana\Contracts\Databases - DatabasesInterface
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Contracts\Databases;

interface DatabasesInterface
{
    /**
     * manual load connection db
     *
     * @param string $connection
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function connection(string $connection = 'default');

    /**
     * manual load table w/o model
     *
     * @param string $table_name
     * @param string $connection
     * @return \Illuminate\Database\Query\Builder
     */
    public function table(string $table_name, string $connection = 'default');

    /**
     * manual insert table w/o model
     *
     * @param string $table_name
     * @param array $insert_data
     * @param string $connection
     * @return bool
     */
    public function insert_table(string $table_name, array $insert_data = [], string $connection = 'default');

    /**
     * manual insert table w/o model and return insert id
     *
     * @param string $table_name
     * @param array $insert_data
     * @param string $connection
     * @return bool|integer
     */
    public function insert_return_id_table(string $table_name, array $insert_data = array(), string $connection = 'default', string $custom_id_field = null);

    /**
     * manual update table w/o model
     *
     * @param string $table_name
     * @param array $where
     * @param array $update_data
     * @param string $connection
     * @return bool|int
     */
    public function update_table(string $table_name, array $where, array $update_data = [], string $connection = 'default');

    /**
     * manual delete table w/o model
     *
     * @param string $table_name
     * @param array $where
     * @param string $connection
     * @return bool|int
     */
    public function delete_table(string $table_name, array $where, string $connection = 'default');

    /**
     * check database has table or not
     *
     * @param string $table_name
     * @param string $connection (optional connection)
     * @return bool
     */
    public function has_table(string $table_name, string $connection = 'default');

    /**
     * for execute raw query
     *
     * @param string $query
     * @param string $connection
     * @return \Illuminate\Support\Collection
     */
    public function query(string $query, string $connection = 'default');

    /**
     * reference DB:raw() function
     *
     * @param string $query
     * @return \Illuminate\Database\Query\Expression
     */
    public function raw(string $query);

    /**
     * force group by statement
     *
     * @param string $connection
     * @return bool
     */
    public function mysql_force_group_by(string $connection = 'default');

    /**
     * load repository redis
     *
     * @return \Cahayana\Redis\Redis
     */
    public function redis();
}
