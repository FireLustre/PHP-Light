<?php
/**
 * Pdo.php
 * User: wanghui
 * Date: 17/8/24
 * Time: 下午11:29
 */

namespace Light\Database;

class Pdo implements DBAdapter
{
    /**
     * 数据库连接
     *
     * @var bool
     */
    protected static $connection = false;

    public function connection($host, $root, $password, $dbname, $port)
    {
        if (! self::$connection) {
            $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";
            self::$connection = new \PDO($dsn, $root, $password);
        }
        return self::$connection;
    }


    public function query(){}
}