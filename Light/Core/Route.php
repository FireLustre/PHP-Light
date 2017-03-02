<?php
/**
 * 路由类.
 * User: wanghui
 * Date: 17/1/16
 * Time: 下午10:08
 */

namespace Core;


class Route
{

    private static $_instance;

    public static function init()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function handle()
    {
        // 默认路由
        $defalutRoute = DEFALUT_MODULE . '/' . DEFALUT_CONTROLLER . '/' . DEFALUT_ACTION;
        $route = isset($_GET['r']) ? $_GET['r'] : $defalutRoute;
        if (!isset($route) || empty($route)) {
            echo '404 not found!';
            die;
        }
        // 路由处理
        $routeInfo = explode('/', $route);
        if (!isset($routeInfo[0]) || empty($routeInfo[0])) {
            $routeInfo[0] = DEFALUT_MODULE;
        }
        if (!isset($routeInfo[1]) || empty($routeInfo[1])) {
            $routeInfo[1] = DEFALUT_CONTROLLER;
        }
        if (!isset($routeInfo[2]) || empty($routeInfo[2])) {
            $routeInfo[2] = DEFALUT_ACTION;
        }

        define('__MODULE__', ucfirst($routeInfo[0]));
        define('__CONTROLLER__', ucfirst($routeInfo[1]));
        define('__ACTION__', $routeInfo[2]);

        $cNameSpace = __MODULE__ . '\\' . 'Controller';
        $_controller = $cNameSpace . '\\' . __CONTROLLER__ .  CONTROLLER_POSTFIX;
        return $_controller;
    }
    
}