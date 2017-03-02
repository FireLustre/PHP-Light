<?php
/**
 * 异常处理类
 * User: wanghui
 * Date: 17/1/13
 * Time: 下午11:19
 */

namespace Core;

class MyException extends \Exception
{

    public function catchErrorInfo()
    {
        $errorMsg = '<br/><mark>错误信息</mark>&nbsp;&nbsp;&nbsp;<b style=\'color:#000;font-size:20px;font-weight:bold\'>'.$this->getMessage().'</b>';
        return $errorMsg;
    }

}