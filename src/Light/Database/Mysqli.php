<?php
/**
 * Mysqli.php
 * User: wanghui
 * Date: 17/8/24
 * Time: 下午11:29
 */

namespace Light\Database;

class Mysqli implements DBAdapter
{
    /**
     * 数据库连接状态
     *
     * @var null
     */
    protected static $connection = false;

    public function connection($host, $root, $password, $dbname, $port)
    {
        if (! self::$connection) {
            self::$connection = mysqli_connect($host, $root, $password, $dbname, $port);
            if (! self::$connection) {
                throw new \Exception('数据库连接失败，失败原因：' . self::$connection->error);
            }
        }
    }

    public function selectDb(){}

    public function query(){}
}