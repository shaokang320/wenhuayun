<?php
namespace app\Http\Controllers\Enterprise;
use App\Http\Controllers\Enterprise\CommonController;
use DB;
class CultureController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
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
}
