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
    public function connection();

    public function selectDb();

    public function query();
}