<?php
namespace app\Http\Controllers\Enterprise;
use App\Common\ReturnData;
use App\Http\Controllers\Enterprise\CommonController;
use App\Http\Logic\CultureLogic;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CultureController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCultureLogic ()
    {
        return new CultureLogic();
    }

    public function index()
    {
        $res = '';
        $where = function ($query) use ($res) {
            if ($_REQUEST)
            {
                if (isset($_REQUEST["title"])) {
                    $query->where('title', 'like', '%' . myTrim($_REQUEST['title']) . '%');
                }
                if (isset($_REQUEST["status"])) {
                    $query->where('status', myTrim($_REQUEST["status"]));
                }
            }
            $query->where('enterprise_id', $this->enterprise_info['id']);
        };
        $posts = parent::pageList('culture', $where, 'id');
        $data['posts'] = $posts;
        $data['where'] = $_REQUEST;
        return view('enterprise.culture.index',$data);
    }

    public function add()
    {
        $rowCount = DB::table('enterprise')->where(array('id' => $this->enterprise_info['id']))->value('rowCount');
        //获取已发布条数
        $where['enterprise_id'] = $this->enterprise_info['id'];
        $rows = $this->getCultureLogic()->rowCount($where);
        if ($rows['data'] >= $rowCount)
        {
            error_jump('该账号发布条数已使用完，请联系管理员增加条数', route('enterprise_culture'),3);
        }

        return view('enterprise.culture.add');
    }

    public function doadd(Request $request)
    {
        $tmp = $request->file('img');
        $arr = uploadImage($tmp,'enterprise/wenhua','wenhua');
        $_POST['image'] = $arr['path'];
        $_POST['enterprise_id'] = $this->enterprise_info['id'];

        $video = explode("_", $request->video);
        $_POST['video_path'] = '/aetherupload/'.$video[0].'/'.$video[1].'/'.$video[2];
        $res = $this->getCultureLogic()->add($_POST);
        if ($res['code'] == 0)
        {
            $contents = "/uploads/enterprise/wenhua/qrcode/" . date("Y").'/'.date('m').'/'.date('Ymd');
            $path = public_path() . $contents;
            $qrcode = '/'.date('YmdHis').'qrcode.jpg';
            if (!is_dir($path))
            {
                mkdir($path,0777,true);
            }
            QrCode::format('png')->encoding('UTF-8')->size(400)->generate('https://wenhua.newheightchina.com?wenhua_id='.$res['data'],$path.$qrcode);
            $data['qrCode'] = $contents.$qrcode;
            model('Culture')->where('id',$res['data'])->update($data);
            success_jump('添加成功', route('enterprise_culture'),'2');
        }

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
        $info = $this->getCultureLogic()->getOne($where);
        $data['info'] = $info;
        $data['id'] = $id;
        return view('enterprise.culture.edit',$data);
    }

    public function doedit(Request $request)
    {
        if (!empty($request->id)) {
            $id = $request->id;
        } else {
            $id = "";
        }
        if (preg_match('/[0-9]*/', $id)) {
        } else {
            exit;
        }
        if (!empty($request->file('img')))
        {
            $tmp = $request->file('img');
            $arr = uploadImage($tmp,'enterprise/wenhua','wenhua');
            $_POST['image'] = $arr['path'];
        }
        if (!empty($request->video))
        {
            $video = explode("_", $request->video);
            $_POST['video_path'] = '/aetherupload/'.$video[0].'/'.$video[1].'/'.$video[2];
        }
        $where['id'] = $id;
        $res = $this->getCultureLogic()->edit($_POST,$where);
        if ($res['code'] == 0)
        {
            success_jump('添加成功', route('enterprise_culture'),'2');
        }
        error_jump($res['msg']);
    }

    public function del(Request $request)
    {
        $res = $this->getCultureLogic()->del(['id'=>$request->id]);
        if ($res['code'] == 0)
        {
            success_jump('删除成功', route('enterprise_culture'),'2');
        }
        error_jump($res['msg']);
    }

    public function editStatus()
    {
        $id = $_POST["id"];
        unset($_POST["_token"]);
        unset($_POST["id"]);
        $_POST['updateTime'] = date('Y-m-d H:i:s'); //添加&更新时间
        if (model('Culture')->where('id',$id)->update($_POST))
        {
            return ReturnData::create(ReturnData::SUCCESS);
        } else
        {
            return ReturnData::create(ReturnData::SYSTEM_FAIL);
        }
    }
}
