<?php
namespace App\Common;

use Illuminate\Support\Facades\DB;

class Token
{
    const TYPE_APP     = 0;
    const TYPE_ADMIN   = 1;
    const TYPE_WEIXIN  = 2;
    const TYPE_WAP     = 3;
    const TYPE_PC      = 4;
	
    // 已验证的type
    public static $type;
    // 验证为token时的uid
    public static $uid;
    // 验证为sign时的app.id
    public static $app;
    // 已验证的data
    public static $data = array();
	
    /**
     * 验证token
     * 
     * @param $token
     * 
     * @return bool
     */
    public static function checkToken($token)
    {
        $token = DB::table('member_token')->where(array('login_token'=>$token))->first();
		
        if ($token)
		{
            self::$type = $token->type;
            self::$uid  = $token->member_id;
            self::$data = $token->data ? json_decode($token->data, true) : array();
        }
		
        return $token ? true : false;
    }
	
    /**
     * 验证sign，
     * sign生成方式：md5(app_key + app_secret + time)
     * 必传参数：app_key, sign, sign_time
     * 
     * @param $appKey
     * @param $signTime
     * @param $sign
     * 
     * @return bool
     */
//    public static function checkSign($appKey, $signTime, $sign)
//    {
//        if (!$appRes = DB::table('appsign')->where('app_key', $appKey)->first())
//		{
//            return false;
//        }
//
//        //验证sign
//        $newSign = md5($appKey . $appRes->app_secret . $signTime);
//        if ($sign == $newSign)
//		{
//            self::$type = self::TYPE_ADMIN;
//            self::$app  = $appRes;
//            return true;
//        }
//
//        return false;
//    }
	
    /**
     * 生成token
     *
     * @param $type
     * @param $uid
     * @param $data
     *
     * @return string
     */
    public static function getToken($type, $uid, $data = array())
    {
        //支持多账号登录
        if ($token = DB::table('member_token')->where(array('type' => $type, 'member_id' => $uid))->orderBy('token_id', 'desc')->first())
		{
            if(strtotime($token->expire_time)>time())
			{
                return array('access_token'=>$token->login_token,'expired_at'=>$token->expire_time,'member_id'=>$token->member_id,'type'=>$token->type);
            }
        }
		
        //生成新token
        $token = md5($type . '-' . $uid . '-' . microtime() . rand(0, 9999));
        $expired_at = date("Y-m-d H:i:s",(time()+3600*24*30)); //token 30天过期
        
        DB::table('member_token')->insert(array(
            'login_token'      => $token,
            'type'       => $type,
            'member_id'        => $uid,
            'data'       => $data ? json_encode($data) : '',
            'expire_time' => $expired_at
        ));
		
        return array('access_token'=>$token,'expire_time'=>$expired_at,'member_id'=>$uid,'type'=>$type);
    }
}