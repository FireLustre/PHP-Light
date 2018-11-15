<?php

/**
 * DBAdapter.php
 * User: wanghui
 * Date: 17/8/24
 * Time: 下午11:25
 */
namespace Light\Database;

interface DBAdapter
{
    /**
     * 数据库连接
     * 数据库如果功能做的单一，如只有query
     * 而如果又要做ORM，需要花大量的时间，所以还是打算把model层的实现放在最后
     *
     * @param $host
     * @param $root
     * @param $password
     * @param $dbname
     * @param $port
     * @return mixed
     */
    public function connection($host, $root, $password, $dbname, $port);

    public function query();
}