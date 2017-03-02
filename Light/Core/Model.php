<?php
/**
 * User: wanghui
 * Date: 17/1/15
 * Time: 下午10:33
 */

namespace Core;

class Model
{
    private static $_instance;
    private static $_con = FALSE;

    function __construct()
    {
        if (!self::$_con) {
            self::$_con = mysqli_connect(C('DB_HOST'), C('DB_USER'), C('DB_PWD'), C('DB_NAME'));
            if (!self::$_con) {
                E("Connection failed: " . self::$_con->mysqli_connect_error());
            }
            self::$_con->query('set names utf8');
        }
    }

    /**
     * @param $dbname
     * @return Model
     */
    public static function init()
    {
         if (!(self::$_instance instanceof self)) {
             self::$_instance = new self;
         }
         return self::$_instance;
    }

    /**
     * 数据库查询操作
     * @param  [string] $SQL [查询语句]
     * @return $mixed
     */
    public function query($SQL)
    {
        $data = array();
        $result = self::$_con->query($SQL);
        // SQL执行成功
        if (!$result) {
            E('Mysql Error Info: ' . self::$_con->mysqli_errno() . ' - ' . self::$_con->mysqli_error());
        }
        // SQL增删改操作[boolean]
        if (!is_object($result)) {
            return $result;
        }
        // SQL查询操作[array] 一条条获取
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        if (!$data) {
            return NULL;
        }
        // 释放结果集合
        mysqli_free_result($result);
        return $data;
    }

    public function field($string)
    {
        return $this;
    }
    public function where($string)
    {
        return $this;
    }

    public function find()
    {

    }

    public function select()
    {
        
    }

    public function count()
    {

    }

}