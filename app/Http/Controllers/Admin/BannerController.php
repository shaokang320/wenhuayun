<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/8/24
 * Time: 15:25
 */
namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Admin\CommonController;
use App\Common\ReturnData;
use App\Http\Model\Banner;

class BannerController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (isPostRequest())
        {
            if (empty($_POST["banner_img"])) {
                $_POST['banner_img'] = '';
            }
            unset($_POST["_token"]);
            $_POST['banner_img'] = join('|||',$_POST['banner_img']);
            $id = $_POST["banner_id"];
            if ($id)
            {
                $where['banner_id'] = $id;
                $_POST['updateTime'] = date('Y-m-d H:i:s'); //添加&更新时间
                unset($_POST["banner_id"]);
                if (Banner::where($where)->update(array_filter($_POST)))
                {
                    success_jump('操作成功', route('admin_banner'),'2');
                } else
                {
                    error_jump('操作失败！请联系管理员');
                }
            }else
            {
                $_POST['createTime'] = $_POST['updateTime'] = date('Y-m-d H:i:s'); //添加&更新时间
                if (Banner::insert(array_filter($_POST)))
                {
                    success_jump('操作成功', route('admin_banner'),'2');
                } else
                {
                    error_jump('操作失败！请联系管理员');
                }
            }
        }
        $bannerInfo = Banner::first();
        if ($bannerInfo)
        {
            $bannerInfo->banner_img = explode('|||',$bannerInfo->banner_img);
        }
        $data['bannerInfo'] = $bannerInfo;
        return view('admin.banner.index',$data);
    }
}
