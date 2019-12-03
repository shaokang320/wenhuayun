<?php
namespace App\Http\Controllers\Weixin;
use App\Http\Controllers\Weixin\CommonController;
use DB;
use Illuminate\Http\Request;

class IndexController extends CommonController
{

    public function index(Request $request)
    {
        if (isset($request->wenhua_id))
        {
            $data = model('Culture')->where('id',$request->wenhua_id)->first();
            var_dump($data);die;
        }elseif(isset($request->id))
        {
            $data = model('Enterprise')->where('id',$request->id)->first();
        }
        $data['info'] = $data;
        $this->ApiJson('200',$data,'请求成功');
    }

}
