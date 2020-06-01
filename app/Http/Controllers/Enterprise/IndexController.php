<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/5/27
 * Time: 10:31
 */
namespace app\Http\Controllers\Enterprise;
use App\Http\Controllers\Enterprise\CommonController;
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
        return view('enterprise.index.welcome',$data);
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
            $enterprise_user = DB::table('enterprise')->where(array('id'=>$this->enterprise_info['id'],'password' => md5($_POST['old_password'])))->first();
            if ($enterprise_user)
            {
                if (DB::table('enterprise')->where(array('id'=>$this->enterprise_info['id'],'password' => md5($_POST['old_password'])))->update(['password'=>md5($_POST['new2_password'])]))
                {
                    error_jump('密码修改成功,请重新登录',route('enterprise_logout'));
                }
                error_jump('密码修改失败');
            }
            error_jump('原始密码错误');
        }

        return view('enterprise.index.editPassword');
    }

}
