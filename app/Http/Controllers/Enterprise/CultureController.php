<?php
namespace app\Http\Controllers\Enterprise;
use App\Http\Controllers\Enterprise\CommonController;
use App\Http\Logic\CultureLogic;
use DB;
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
            $qrcode = '/'.date('YmdHis').'.png';
            if (!is_dir($path))
            {
                mkdir($path,0777,true);
            }
            QrCode::size(200)->generate('https://wenhua.newheightchina.com?wenhua_id='.$res['data'],$path.$qrcode);
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
            $qrcode = '/'.date('YmdHis').'.png';
            if (!is_dir($path))
            {
                mkdir($path,0777,true);
            }
            QrCode::size(200)->generate('https://wenhua.newheightchina.com?wenhua_id='.$res['data'],$path.$qrcode);
            $data['qrCode'] = $contents.$qrcode;
            model('Culture')->where('id',$res['data'])->update($data);
            success_jump('添加成功', route('enterprise_culture'),'2');
        }
    }

    public function del(Request $request)
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
            $qrcode = '/'.date('YmdHis').'.png';
            if (!is_dir($path))
            {
                mkdir($path,0777,true);
            }
            QrCode::size(200)->generate('https://wenhua.newheightchina.com?wenhua_id='.$res['data'],$path.$qrcode);
            $data['qrCode'] = $contents.$qrcode;
            model('Culture')->where('id',$res['data'])->update($data);
            success_jump('添加成功', route('enterprise_culture'),'2');
        }
    }
}
