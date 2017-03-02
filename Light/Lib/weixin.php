<?php
/**
 * 微信类
 * User: wanghui
 * Date: 17/1/16
 * Time: 下午10:33
 */

class weixin {

    private $appId = 'wx67a22c914aac3918';
    private $appSecret = 'c664ea68c86c2700598e128b2748642f';
    static protected $accessToken = '';

    public function __construct() {
        $appId = C('WX_APPID');
        $appSecret = C('WX_APPSECRET');
        $this->appId = !empty($appId) ? $appId : $this->appId;
        $this->appSecret = !empty($appSecret) ? $appSecret : $this->appSecret;
    }

    /**
     * 获取用户信息
     * @param $typeStr snsapi_base 获取openid,snsapi_userinfo可通过openid拿到昵称、性别、所在地
     */
    public function weixinAuth($typeStr = 'snsapi_base') {
        $redirectUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php?' . $_SERVER['QUERY_STRING'];
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->appId . '&redirect_uri=' . $redirectUrl . '&response_type=code&scope=' . $typeStr . '&state=STATE#wechat_redirect';
        header('Location:' . $url);
    }

    /**
     * 获取access token
     * @return mixed
     */
    public function getAccessToken() {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->appId . '&secret=' . $this->appSecret;
        $accessTokenData = curlGet($url);
        $accessTokenArray = json_decode($accessTokenData, true);
        $accessToken = $accessTokenArray['access_token'];
        return $accessToken;
    }

    /**
     * 授权AccessToken
     * 微信授权code
     * @param string $code
     * @return string
     */
    public function wxOauthAccessToken($code) {
        if (!$code) {
            return false;
        }
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->appId .'&secret=' . $this->appSecret . '&code=' . $code . '&grant_type=authorization_code';
        $accessTokenData = curlGet($url);
        return json_decode($accessTokenData, true);
    }

    /**
     * 获取微信用户信息
     * @return array
     */
    public function getWxUserInfo($openId, $accessToken) {
        if (!$openId || !$accessToken) {
            return false;
        }
        $wxUserInfo = array();
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $accessToken . '&openid=' . $openId . '&lang=zh_CN';
        $wxUserInfo = curlGet($url);
        return $wxUserInfo;
    }

    /**
     * 客服消息接口
     * @param string $msg
     */
    public function sendMessage($msg = '客服繁忙') {
        if (!self::$accessToken) {
            self::$accessToken = $this->getAccessToken();
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.self::$accessToken;
        curlPost($url, $msg);
    }
}
