<?php
namespace App\Http\Controllers\Enterprise;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class LoginController extends BaseController
{
    //页面跳转
    public function jump()
    {
        return view('enterprise.index.jump');
    }
    /**
     * 登录页面
     */
    public function login()
    {
        if(isset($_SESSION['enterprise_user_info']))
        {
            header("Location: ".route('enterprise'));
            exit;
        }

        return view('enterprise.login.login');
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

        $enterprise_user = DB::table('enterprise')->where(array('accounts' => $username, 'password' => $pwd))->first();
        if($enterprise_user)
        {
            if ($enterprise_user->status == 1)
            {
                error_jump('该账号已被禁止登录,请联系管理员', route('enterprise_login'),3);
            }
            if (strtotime(date($enterprise_user->end_time))<time())
            {
                error_jump('该账号使用权限已到期,请联系管理员', route('enterprise_login'),3);
            }
            $enterprise_user_info = object_to_array($enterprise_user, 1);
            $_SESSION['enterprise_user_info'] = $enterprise_user_info;

            return redirect()->route('enterprise');
        }
        error_jump('账号或密码错误', route('enterprise_login'));
    }


    //退出登录
    public function logout()
    {
        session_unset();
        session_destroy();// 退出登录，清除session
        return redirect()->route('enterprise_login');
    }
}
