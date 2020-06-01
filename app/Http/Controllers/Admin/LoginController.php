<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class LoginController extends BaseController
{
    //页面跳转
    public function jump()
    {
        return view('admin.index.jump');
    }
    /**
     * 登录页面
     */
    public function login()
    {

        if(isset($_SESSION['admin_user_info']))
        {
            header("Location: ".route('admin'));
            exit;
        }

        return view('admin.login.login');
    }

    /**
     * 登录处理页面
     */
    public function dologin()
    {
        if(!empty($_POST["username"]))
        {
            $username = $_POST["username"];
        }else{
            $username='';exit;
        }
        if(!empty($_POST["password"]))
        {
            $pwd = md5($_POST["password"]);
        }else{
            $pwd='';exit;
        }
        $admin_user = DB::table('admin')->where(array('admin_username' => $username, 'admin_password' => $pwd))->first();

        if($admin_user)
        {
            $admin_user_info = object_to_array($admin_user, 1);
            $_SESSION['admin_user_info'] = $admin_user_info;
            return redirect()->route('admin');
        }

        error_jump('账号或密码错误', route('admin_login'));
    }

    //退出登录
    public function logout()
    {
        session_unset();
        session_destroy();// 退出登录，清除session
        return redirect()->route('admin_login');
    }

    //密码恢复
    public function recoverpwd()
    {
        $data["username"] = "admin888";
        $data["pwd"] = "21232f297a57a5a743894a0e4a801fc3";

        if(DB::table('admin')->where('id', 1)->update($data))
        {
            success_jump('密码恢复成功', route('admin_login'));
        }

        error_jump('密码恢复失败', route('home'));
    }
}
