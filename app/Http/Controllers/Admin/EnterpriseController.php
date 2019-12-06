<?php
namespace app\Http\Controllers\Admin;
use App\Common\ReturnData;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Logic\EnterpriseLogic;
use DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EnterpriseController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getEnterpriseLogic()
    {
        return new EnterpriseLogic();
    }
    public function index()
    {
        $res = '';
        $where = function ($query) use ($res) {
            if ($_REQUEST)
            {
                if (isset($_REQUEST["name"])) {
                    $query->where('name', 'like', '%' . myTrim($_REQUEST['name']) . '%');
                }
                if (isset($_REQUEST["accounts"])) {
                    $query->where('accounts', myTrim($_REQUEST["accounts"]));
                }
                if (isset($_REQUEST["status"])) {
                    $query->where('status', myTrim($_REQUEST["status"]));
                }
            }
        };
        $posts = parent::pageList('enterprise', $where, 'id');
        $data['posts'] = $posts;
        $data['where'] = $_REQUEST;
        return view('admin.enterprise.index',$data);
    }

    public function add()
    {
        return view('admin.enterprise.add');
    }

    public function doadd()
    {

        if (model('Enterprise')->where('accounts',$_POST['accounts'])->count())
        {
            error_jump('帐号已存在');
        }
        unset($_POST['_token']);
        $res = $this->getEnterpriseLogic()->add($_POST);
        if($res['code'] == 0)
        {
            $contents = "/uploads/enterprise/qrcode/" . date("Y").'/'.date('m').'/'.date('Ymd');
            $path = public_path() . $contents;
            $qrcode = '/'.date('YmdHis').'qrcode.jpg';
            if (!is_dir($path))
            {
                mkdir($path,0777,true);
            }
            QrCode::format('png')->encoding('UTF-8')->size(200)->generate('https://wenhua.newheightchina.com?id='.$res['data'],$path.$qrcode);
            $data['qrCode'] = $contents.$qrcode;
            model('Enterprise')->where('id',$res['data'])->update($data);
            success_jump('添加成功', route('admin_enterprise'),'2');
        }
        error_jump('添加失败！'.$res['msg']);
    }
    public function edit()
    {
        if (!empty($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            $id = "";
        }
        if (preg_match('/[0-9]*/', $id)) {
        } else {
            exit;
        }
        $where['id'] = $id;
        $info = $this->getEnterpriseLogic()->getOne($where);
        $data['info'] = $info;
        $data['id'] = $id;
        return view('admin.enterprise.edit',$data);
    }

    public function doedit()
    {
        if (model('Enterprise')->where('accounts',$_POST['accounts'])->whereNotIn('id',[$_POST['id']])->count())
        {
            error_jump('帐号已存在');
        }
        unset($_POST['_token']);
        $where['id'] = $_POST['id'];
        $res = $this->getEnterpriseLogic()->edit($_POST,$where);
        if ($res['code'] == '0')
        {
            success_jump('修改成功', route('admin_enterprise'),'2');
        }
        error_jump('修改失败！'.$res['msg']);
    }
    public function editStatus()
    {
        $id = $_POST["id"];
        unset($_POST["_token"]);
        unset($_POST["id"]);
        if (isset($_POST["password"]))
        {
            $_POST["password"] = md5($_POST["password"]);
        }
        $_POST['updateTime'] = date('Y-m-d H:i:s'); //更新时间
        if (model('Enterprise')->where('id',$id)->update($_POST))
        {
            return ReturnData::create(ReturnData::SUCCESS);
        } else
        {
            return ReturnData::create(ReturnData::SYSTEM_FAIL);
        }
    }

    public function del()
    {
        if (!empty($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            error_jump('删除失败！请重新提交');
        }
        $where['id'] = $id;
        $res = $this->getEnterpriseLogic()->del($where);
        if ($res['code'] == 0) {
            success_jump("$id ,删除成功");
        } else {
            error_jump("$id ,删除失败！请重新提交");
        }
    }
}
