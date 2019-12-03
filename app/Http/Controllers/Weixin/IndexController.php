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
            $res = model('Culture')
                ->join('enterprise','enterprise.id','=','culture.enterprise_id')
                ->where('culture.id',$request->wenhua_id)
                ->select('culture.*','enterprise.mobile,enterprise.longitude,enterprise.latitude')
                ->first();
        }elseif(isset($request->id))
        {
            $res = model('Enterprise')->where('id',$request->id)->first();
        }
        $data['info'] = $res;
        $this->ApiJson('200',$data,'请求成功');
    }

}
