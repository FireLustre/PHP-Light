<?php
//设置编码格式
header("Content-type: text/html; charset=utf-8");
//设置中国时区
date_default_timezone_set('PRC');
session_start();
define('CORE', PATH . '/Light');

//解析路由 lms/Index
class Base
{
    private static $_instance;
    private static $_classLib;

    public function __clone() {}

    public function __construct()
    {

        spl_autoload_register(array('Base', 'autoload'));
    }

    /**
     * 自动加载函数
     * @param $name
     * @return bool
     */
    public static function autoload($name)
    {

        $classLib = self::$_classLib;
        if (isset($classLib[$name])) {
            return TRUE;
        }
        $class = PATH . '/' . APP . '/' . str_replace('\\', '/', $name) . '.php';
        if (is_file($class)) {
            //命名空间加载类
            self::$_classLib[$name] = $class;
            include $class;
            return TRUE;
        } else {
            //手动引入类
            $handleClassLib = array(
                'Core\Config'      => CORE . '/Core/Config.php',
                'Core\Controller'  => CORE . '/Core/Controller.php',
                'Core\MyException' => CORE . '/Core/MyException.php',
                'Core\Model'       => CORE . '/Core/Model.php',
                'Core\Route'       => CORE . '/Core/Route.php',
            );
            $coreClass = $handleClassLib[$name];

            if (is_file($coreClass)) {
                self::$_classLib[$name] = $coreClass;
                include $coreClass;
                return TRUE;
            }
            return FALSE;
        }

    }

    // 单列模式实例化本类的一个对象
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     * 初始化
     * @return [type] [description]
     */
    public static function init()
    {
        // 公共文件库目录
        $directory = CORE .'/Common';
        // 遍历引入
        if (false !== ($commonDir = opendir ($directory))) {

            while (false !== ($file = readdir($commonDir))) {

                // 引入公共库文件
                if ($file != '.' && $file != '..' && !is_dir($directory . '/' . $file)) {
                    include_once $directory . '/' . $file;
                }

            }

        }
        // 单列模式
        self::getInstance();
        return self::$_instance;
    }

    //创建应用模块
    public function createWebApp()
    {
        $controller = Core\Route::init()->handle();
        $cObj = new $controller;
        if(method_exists($cObj, '_initialize')){
            $cObj->_initialize();
        }
        $_act = __ACTION__;
        $cObj->$_act();
    }

}
