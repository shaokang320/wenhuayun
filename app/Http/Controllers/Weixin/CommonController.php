<?php
namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use App\Common\Helper;
use DB;
class CommonController extends Controller
{
    protected $isWechatBrowser;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->isWechatBrowser = Helper::isWechatBrowser();
        view()->share('isWechatBrowser', $this->isWechatBrowser);
    }

    /**
     * Shop 接口数据返回
     * @param  $message 消息
     * @param  $resData 具体数据
     * @param  $code 200成功203失败
     * @return jsonRPCClient
     * @author csk
     */
    function ApiJson($code='',$reData='',$message='')
    {
        header('Content-Type:application/json; charset=utf-8');
        $value=array(
            'code'=>$code,
            'resData'=>$reData,
            'msg'=>$message
        );

        exit(json_encode($value));//转为json格式
    }
}