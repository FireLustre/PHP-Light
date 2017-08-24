<?php
/**
 * DB.php
 * User: wanghui
 * Date: 17/8/24
 * Time: 下午11:30
 */

namespace Light\Database;

class DB
{
    /**
     * 服务器ip
     *
     * @var string
     */
    private $host = '127.0.0.1';

    /**
     * 端口号
     *
     * @var string
     */
    private $port = '3306';

    /**
     * 用户名
     *
     * @var string
     */
    private $root = '127.0.0.1';

    /**
     * 密码
     *
     * @var string
     */
    private $password = '';

    /**
     * 表前缀
     *
     * @var string
     */
    protected $prefix = '';

    public function __construct()
    {

    }
}