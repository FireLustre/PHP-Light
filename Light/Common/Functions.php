<?php
/**
 * 公用方法.
 * User: wanghui
 * Date: 17/1/16
 * Time: 下午10:28
 */

/**
 * 打印函数
 * @param  [type] $param [description]
 * @return [type]        [description]
 */
function dd($param) 
{
    if (empty($param)) {
        echo "null\n";
    }
    if (is_array($param)) {
        echo '<pre>';
        var_dump($param);
        echo '</pre>';
    } else {
        echo $param;
    }
    return ;
}

/**
 * E 异常抛出函数
 * @param string $msg [description]
 */
function E($msg = '')
{
    $traceInfo = debug_backtrace();
    $myException = new Core\MyException($msg);
    echo $myException->catchErrorInfo();
    echo '<p>Trace</p>';
    // 打印报错页面信息
    foreach ($traceInfo as $key => $_debug) {
        echo  '#'. $key . '&nbsp;' . $_debug['file'] . '(' . $_debug['line'] . ')<br/><br/>';
    }
    die;
}

/**
 * 数据库模型函数
 */
function M()
{
    $model = Core\Model::init();
    return $model;
}

/**
 * 配置读取
 * @param $nameStr
 * @return mixed|string
 */
function C($nameStr)
{
    return Core\Config::init()->handleConfig($nameStr);
}

function I($receiveStr, $defaultVal)
{
    $realVal = '';
    $receiveStrInfo = explode('.', $receiveStr);
    $method = $receiveStrInfo[0];
    $paramInfo = explode('\/', end($receiveStrInfo));
    // 参数名称
    $paramName = $paramInfo[0];
    // 参数类型
    $paramType = isset($paramInfo[1]) ? $paramInfo[1] : '';
    if (strtoupper($method) === 'POST') {
        $realVal = $_POST[$paramName];
    } else if (strtoupper($method) === 'GET') {
        $realVal = $_GET[$paramName];
    } else {
        E('请求方式错误!');
    }
    switch ($paramType) {
        case 'd':
            // 整形类型
            $realVal = intval($realVal);
            break;
        default:
            // 默认字符串格式
            $realVal = trim($realVal);
            break;
    }
    // 若不存在，则设置默认
    if (!$realVal) {
        $realVal = $defaultVal;
    }
    return $realVal;
}

/**
 * 类库引入函数
 * @param $className
 */
function Lib($className)
{
    include_once CORE . '/Lib/' . $className . '.php';
    return;
}

/**
 * curl get请求
 */
function curlGet($url)
{
    // 初始化
    $ch = curl_init();
    // 设置选项
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    // 执行获取内容
    $output = curl_exec($ch);
    // 释放句柄
    curl_close($ch);
    return $output;
}

/**
 * curl post请求
 */
function curlPost($url, $param)
{
    // 初始化
    $ch = curl_init();
    // 设置选项
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // post方式发送参数
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    // 执行获取内容
    $output = curl_exec($ch);
    // 释放句柄
    curl_close($ch);
    return $output;
}

/**
 * session设置/获取函数
 * @param $name
 * @param string $value
 * @return mixed
 */
function session($name, $value = '')
{
    if ($value !== '') {
        $paramType = gettype($value);
        if ($paramType !== 'NULL' && $paramType !== 'unknown type') {
            $_SESSION[$name] = $value;
        } else {
            $_SESSION[$name] = null;
        }
    }
    
    return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
}

function debug($msg)
{
    echo $msg . '<br/>';
}

/**
 * 服务层实例化函数
 * @param $name
 * @param $type
 * @return mixed
 */
function D($name, $type)
{
    $serviceType = ucfirst($type);
    $serviceName = __MODULE__.'\\' . $serviceType . '\\' . $name . $serviceType;
    $service = new $serviceName;
    return $service;
}
