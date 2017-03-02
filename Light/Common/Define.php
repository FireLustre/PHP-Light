<?php
/**
 * 常量配置.
 * User: wanghui
 * Date: 17/1/16
 * Time: 下午10:23
 */

// 基本路径常量配置
if (!defined('Vender')) { define('Vender', 'vendor'); }

// if (!defined('__RESOURCE__')) { define('__RESOURCE__', RESOURCE . '/' . __MODULE__); }
// if (!defined('__IMAGE__')) { define('__IMAGE__', __RESOURCE__ . '/image/' ); }
// if (!defined('__JS__')) { define('__JS__', __RESOURCE__ . '/js/' ); }
// if (!defined('__CSS__')) { define('__CSS__', __RESOURCE__ . '/css/'); }

// 默认参数配置
if (!defined('DEFALUT_MODULE')) { define('DEFALUT_MODULE', 'Home'); }
if (!defined('DEFALUT_CONTROLLER')) { define('DEFALUT_CONTROLLER', 'Index'); }
if (!defined('DEFALUT_ACTION')) { define('DEFALUT_ACTION', 'index'); }
if (!defined('CONTROLLER_POSTFIX')) { define('CONTROLLER_POSTFIX', 'Controller'); }
if (!defined('TEMPLATE_POSTFIX')) { define('TEMPLATE_POSTFIX', '.html'); }
if (!defined('DEBUG')) { define('DEBUG', FALSE); }
if (!defined('TEMPLATE_CACHE')) { define('TEMPLATE_CACHE', TRUE); }

