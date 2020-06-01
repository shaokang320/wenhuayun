<?php
namespace app\Http\Controllers\Enterprise;
use App\Common\ReturnData;
use App\Http\Controllers\Enterprise\CommonController;
use App\Http\Logic\EnterpriseLogic;
use DB;
class ProductController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEnterpriseLogic ()
    {
        return new EnterpriseLogic();
    }

    public function index()
    {
        if (isPostRequest())
        {
            $res = $this->getEnterpriseLogic()->edit($_POST,['id'=>$this->enterprise_info['id']]);
            if ($res['code'] == ReturnData::SUCCESS)
            {
                return ReturnData::create(ReturnData::SUCCESS);
            } else
            {
                return ReturnData::create(ReturnData::SYSTEM_FAIL,'',$res['msg']);
            }
        }
        $info = $this->getEnterpriseLogic()->getOne(['id'=>$this->enterprise_info['id']]);

        $data['info'] = $info;
        return view('enterprise.product.index',$data);
    }
}
