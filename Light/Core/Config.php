<?php
/**
 * 配置类
 * User: wanghui
 * Date: 17/1/16
 * Time: 下午10:06
 */
namespace Core;

class Config
{

    private static $_instance;
    private static $config = array();
    // 模块配置
    protected static $moduleConfig = array();
    // 系统配置
    protected static $coreConfig = array();

    //初始化
    public static function init()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    //获取配置信息
    public function handleConfig($nameStr)
    {
        if (!self::$moduleConfig) {
            self::$moduleConfig = include_once APP . '/' . __MODULE__ .'/Common/config.php';
        }
        if (!self::$coreConfig) {
            self::$coreConfig = include_once CORE . '/Config/Config.php';
        }
        if (!$nameStr) {
            E('配置项名称不能为空');
        }
        $configValue = isset(self::$config[$nameStr]) ? self::$config[$nameStr] : '';
        // 若配置项不存在
        if ('' === $configValue) {
            $nameGroup = explode('.', $nameStr);
            // 从模块配置中读取
            $moduleConfig = self::$moduleConfig;
            // 一维配置信息
            if (1 == count($nameGroup)) {
                $configValue = isset($moduleConfig[$nameGroup[0]]) ? $moduleConfig[$nameGroup[0]] : '';
                // 从系统配置中读取
                if ('' === $configValue) {
                    $coreConfig = self::$coreConfig;
                    $configValue = isset($coreConfig[$nameGroup[0]]) ? $coreConfig[$nameGroup[0]] : '';  
                }
            } else {
                // 二维配置信息
                foreach ($nameGroup as $key => $_name) {
                    $configValue = isset($moduleConfig[$nameGroup[0]][$nameGroup[1]]) ? $moduleConfig[$nameGroup[0]][$nameGroup[1]] : '';   
                    // 从系统配置中读取
                    if ('' === $configValue) {
                        $coreConfig = self::$coreConfig;
                        $configValue = isset($coreConfig[$nameGroup[0]][$nameGroup[1]]) ? $coreConfig[$nameGroup[0]][$nameGroup[1]] : '';  
                    }
                }
                // 保存
                self::$config[$nameStr] = $configValue;
            }
            
        }
        return $configValue;
    }
}