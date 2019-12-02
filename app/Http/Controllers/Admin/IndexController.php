<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/5/27
 * Time: 10:31
 */
namespace app\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
use DB;
class IndexController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['laravel_version'] = app()->version();
        $data['system_info_mysql'] = object_to_array(DB::query("select version() as v;"),1);
        return view('admin.index.welcome',$data);
    }

    //修改密码
    public function editPwd()
    {
        if (isPostRequest())
        {
            if ($_POST['new_password'] != $_POST['new2_password'])
            {
                error_jump('新密码两次输入不一致');
            }
            unset($_POST["_token"]);
            $admin_user = DB::table('admin')->where(array('admin_password' => md5($_POST['old_password'])))->first();
            if ($admin_user)
            {
                if (DB::table('admin')->where(array('admin_password' => md5($_POST['old_password'])))->update(['admin_password'=>md5($_POST['new2_password'])]))
                {
                    error_jump('密码修改成功,请重新登录',route('admin_logout'));
                }
                error_jump('密码修改失败');
            }
            error_jump('原始密码错误');
        }

        return view('admin.index.editPassword');
    }

}
