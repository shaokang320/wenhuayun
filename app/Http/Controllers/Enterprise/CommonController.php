<?php
namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use DB;

class CommonController extends Controller
{
	public $enterprise_info;

    public function __construct()
    {
        parent::__construct();
		//判断是否登录
		if(isset($_SESSION['enterprise_user_info']))
		{
			$this->enterprise_info = $_SESSION['enterprise_user_info'];
		}
        else
        {
            header("Location:".route('enterprise_login'));
			exit();
        }
    }

    /**
     * 获取分页数据及分页导航
     * @param string $modelname 模块名与数据库表名对应
     * @param array  $where     查询条件
     * @param string $orderby   查询排序
     * @param string $field     要返回数据的字段
     * @param int    $listRows  每页数量，默认30条
     *
     * @return 格式化后输出的数据。内容格式为：
     *     - "code"                 (string)：代码
     *     - "info"                 (string)：信息提示
     *
     *     - "result" array
     *
     *     - "img_list"             (array) ：图片队列，默认8张
     *     - "img_title"            (string)：车图名称
     *     - "img_url"              (string)：车图片url地址
     *     - "car_name"             (string)：车名称
     */
    public function pageList($modelname, $where = '', $id='', $orderby = '', $field = '*', $listRows = 15)
    {
        $model = \DB::table($modelname);
		//查询条件
        if (!empty($where)) {
            $model = $model->where($where);
        }

		//排序
        if($orderby!='')
		{
            if($orderby == 'rand()')
            {
                $model = $model->orderBy(\DB::raw('rand()'));
            }
            else
            {
    			if(count($orderby) == count($orderby, 1))
    			{
    				$model = $model->orderBy($orderby[0], $orderby[1]);
    			}
    			else
    			{
    				foreach($orderby as $row)
    				{
    					$model = $model->orderBy($row[0], $row[1]);
    				}
    			}
            }
		}
        else
        {
            $model = $model->orderBy($id, 'desc');
//            var_dump($model);die;
        }

		//要返回的字段
        if($field!='*'){$model = $model->select(\DB::raw($field));}
        return $model->paginate($listRows);
    }
}
