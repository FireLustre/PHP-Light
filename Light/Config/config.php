<?php
/**
 * 核心配置信息
 * User: wanghui
 * Date: 17/1/16
 * Time: 下午10:01
 */

return array(

    /* 数据库设置 */
    'DB_HOST' => 'localhost',
    'DB_USER' => 'root',
    'DB_PWD'  => '',
    'DB_PORT' => 3306,
    /* Redis缓存设置 */
    'DB_CACHE_TYPE' => 'redis',

    /* SESSION设置 */
    'SESSION_LEFETIME'    =>  86399,    // session 过期时间
);
