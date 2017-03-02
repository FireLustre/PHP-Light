<?php

namespace Core;

class Controller
{
    public static $assign = array();

    /**
     * 模板赋值函数
     * @param  string $key     [description]
     * @param  array  $_assign [description]
     * @return [type]          [description]
     */
    public function with($key = '', $_assign = array())
    {
        if ($key === '') {
            array_push(self::$assign, $_assign);
        } else {
            self::$assign[$key] = $_assign;
        }
        
        return $this;
    }

    /**
     * 模板展示函数
     * @param  string $template 模板相对模块路径
     * @return 
     */
    public function view($template = '')
    {
        if (trim($template) === '') {
            // 若模板文件为空，则默认调用由控制器名和方法名拼接的文件名称
            $template = __CONTROLLER__ . '/' . lcfirst(__ACTION__);
        }
        $_template = APP . '/' . __MODULE__ . '/View/' . $template . TEMPLATE_POSTFIX;
        // 模板文件不存在
        if (!is_file($_template)) {
            E($_template . ' 模板文件不存在');
        }
        // 引入扩展自动加载
        require_once Vender . '/autoload.php';
        // 模板文件dir
        $templateDir = APP . '/' . __MODULE__ . '/View/' . __CONTROLLER__;
        \Twig_Autoloader::register();// Composer安装，必须调用Twig注册函数
        $loader = new \Twig_Loader_Filesystem($templateDir);
        // 是否开启页面缓存
        if (TEMPLATE_CACHE) {
            $cacheDir = 'Cache/Templates';
            // 模板缓存目录是否存在
            if (!is_dir($cacheDir)) {
                // 不存在,则自动创建
                mkdir($cacheDir, 0777, TRUE);
            }
            $twig = new \Twig_Environment($loader, array(
                'cache' => $cacheDir,
                'debug' => DEBUG
            ));
        } else {
            $twig = new \Twig_Environment($loader, array('debug' => DEBUG));
        }

        // 获取模板文件名
        $templateArr = explode('/', $_template);
        $templateName = end($templateArr);
        $templateObj = $twig->loadTemplate($templateName);
        $templateObj->display(self::$assign);
        exit;
    }

    /**
     * api返回
     * @param $code
     * @param $codeStr
     * @param $msg
     * @return string
     */
    public function sendAjax($code, $codeStr, $msg)
    {
        $apiInfo = array(
            'code' => $code,
            'codeStr' => $codeStr,
            'msg' => $msg,
        );
        exit(json_encode($apiInfo));
    }
}