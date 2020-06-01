<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/5/27
 * Time: 13:48
 */
//读取动态配置
function sysconfig($varname='')
{
    $SysConfig = cache('SysConfig');
    $res = '';

    if(empty($SysConfig))
    {
        cache()->forget('SysConfig');

        $SysConfig = \App\Http\Model\SysConfig::orderBy('system_id')->select('varname', 'value')->get()->toArray();

        cache(['SysConfig' => $SysConfig], \Carbon\Carbon::now()->addMinutes(86400));
    }

    if($varname != '')
    {
        foreach($SysConfig as $row)
        {

            if($varname == $row['varname'])
            {

                $res = $row['value'];
            }
        }
    }
    else
    {
        $res = $SysConfig;
    }

    return $res;
}

/**
 * 更新配置文件 / 更新系统缓存
 */
function updateconfig()
{
    $str_tmp="<?php\r\n"; //得到php的起始符。$str_tmp将累加
    $str_end="?>"; //php结束符
    $str_tmp.="//全站配置文件\r\n";

    $param = db("system")->select();
    foreach($param as $row)
    {
        $str_tmp .= 'define("'.$row['varname'].'","'.$row['value'].'"); // '.$row['info']."\r\n";
    }

    $str_tmp .= $str_end; //加入结束符
    //保存文件
    $sf = APP_PATH."common.inc.php"; //文件名
    $fp = fopen($sf,"w"); //写方式打开文件
    fwrite($fp,$str_tmp); //存入内容
    fclose($fp); //关闭文件
}

//对象转数组
function object_to_array($object, $get=0)
{
    $res = array();
    if(!empty($object))
    {
        if($get==0)
        {
            foreach($object as $key=>$value)
            {
                $res[$key] = (array)$value;
            }

        }
        elseif($get==1)
        {
            $res = (array)$object;
        }
    }

    return $res;
}
/**
 * 截取中文字符串
 * @param string $string 中文字符串
 * @param int $sublen 截取长度
 * @param int $start 开始长度 默认0
 * @param string $code 编码方式 默认UTF-8
 * @param string $omitted 末尾省略符 默认...
 * @return string
 */
function cut_str($string, $sublen=250, $omitted = '', $start=0, $code='UTF-8')
{
    $string = strip_tags($string);
    $string = str_replace("　","",$string);
    $string = mb_strcut($string,$start,$sublen,$code);
    $string.= $omitted;
    return $string;
}

/**
 * 操作错误跳转的快捷方法
 * @access protected
 * @param string $msg 错误信息
 * @param string $url 页面跳转地址
 * @param mixed $time 当数字时指定跳转时间
 * @return void
 */
function error_jump($msg='', $url='', $time=3)
{
    if ($url=='' && isset($_SERVER["HTTP_REFERER"]))
    {
        $url = $_SERVER["HTTP_REFERER"];
    }

    if(!headers_sent())
    {
        header("Location:".route('admin_jump')."?error=$msg&url=$url&time=$time");
        exit();
    }
    else
    {
        $str = "<meta http-equiv='Refresh' content='URL=".route('admin_jump')."?error=$msg&url=$url&time=$time"."'>";
        exit($str);
    }
}

/**
 * 操作成功跳转的快捷方法
 * @access protected
 * @param string $msg 提示信息
 * @param string $url 页面跳转地址
 * @param mixed $time 当数字时指定跳转时间
 * @return void
 */
function success_jump($msg='', $url='', $time=1)
{
    if ($url=='' && isset($_SERVER["HTTP_REFERER"]))
    {
        $url = $_SERVER["HTTP_REFERER"];
    }

    if(!headers_sent())
    {
        header("Location:".route('admin_jump')."?message=$msg&url=$url&time=$time");
        exit();
    }
    else
    {
        $str = "<meta http-equiv='Refresh' content='URL=".route('admin_jump')."?message=$msg&url=$url&time=$time"."'>";
        exit($str);
    }
}

/**
 * 调用逻辑接口
 * @param $name 逻辑类名称
 * @param array $config 配置
 * @return object
 */
function logic($name = '', $config = [])
{
    static $instance = [];
    $guid = $name . 'Logic';
    if (!isset($instance[$guid]))
    {
        $class = 'App\\Http\\Logic\\' . ucfirst($name) . 'Logic';

        if (class_exists($class))
        {
            $logic = new $class($config);
            $instance[$guid] = $logic;
        }
        else
        {
            throw new Exception('class not exists:' . $class);
        }
    }

    return $instance[$guid];
}

/**
 * 实例化（分层）模型
 * @param $name 模型类名称
 * @param array $config 配置
 * @return object
 */
function model($name = '', $config = [])
{
    static $instance = [];
    $guid = $name . 'Model';
    if (!isset($instance[$guid]))
    {
        $class = '\\App\\Http\\Model\\' . ucfirst($name);
        if (class_exists($class))
        {
            $model = new $class($config);
            $instance[$guid] = $model;
        }
        else
        {
            throw new Exception('class not exists:' . $class);
        }
    }

    return $instance[$guid];
}
//判断是否是图片格式，是返回true
function imgmatch($url)
{
    $info = pathinfo($url);
    if (isset($info['filename']))
    {
        if (($info['filename'] == 'jpg') || ($info['filename'] == 'jpeg') || ($info['filename'] == 'gif') || ($info['filename'] == 'png'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

/**
 * 检查是否是POST请求
 */
function isPostRequest()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST') return true;
    if($_POST) return true;

    return false;
}

/**
 * 是否是GET提交的
 */
function isGetRequest()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
}

/**
 * 获取数据属性
 * @param $dataModel 数据模型
 * @param $data 数据
 * @return array
 */
function getDataAttr($dataModel,$data = [])
{
    if(empty($dataModel) || empty($data))
    {
        return false;
    }

    foreach($data as $k=>$v)
    {
        $_method_str=ucfirst(preg_replace_callback('/_([a-zA-Z])/', function ($match) {
            return strtoupper($match[1]);
        }, $k));

        $_method = 'get' . $_method_str . 'Attr';
        if(method_exists($dataModel, $_method))
        {
            $tmp = $k.'_text';
            $data->$tmp = $dataModel->$_method($data);
        }
    }

    return $data;
}
//判断是否为数字
function checkIsNumber($data)
{
    if($data == '' || $data == null)
    {
        return false;
    }

    if(preg_match("/^\d*$/",$data))
    {
        return true;
    }

    return false;
}
//字符串中所有空白字符过滤掉（空格、全角空格、换行等
function myTrim($str)
{
    $search = array(" ","　","\n","\r","\t");
    $replace = array("","","","","");
    return str_replace($search, $replace, $str);
}

/**
 * 生成支付单编号(两位随机 + 从2000-01-01 00:00:00 到现在的秒数+微秒+会员ID%1000)，该值会传给第三方支付接口
 * 长度 =2位 + 10位 + 3位 + 3位  = 18位
 * 1000个会员同一微秒提订单，重复机率为1/100
 * @return string
 */
function makeShopPaySn($member_id){
    return mt_rand(10,99)
        . sprintf('%010d',time() - 946656000)
        . sprintf('%03d', (float) microtime() * 1000)
        . sprintf('%03d', (int) $member_id % 1000);
}

// 公共函数文件
if (! function_exists('curl_request'))
{
    function curl_request($api, $params = array(), $method = 'GET', $headers = array())
    {
        $curl = curl_init();

        switch (strtoupper($method))
        {
            case 'GET' :
                if (!empty($params))
                {
                    $api .= (strpos($api, '?') ? '&' : '?') . http_build_query($params);
                }
                curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
                break;
            case 'POST' :
                curl_setopt($curl, CURLOPT_POST, TRUE);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            case 'PUT' :
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            case 'DELETE' :
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
        }

        curl_setopt($curl, CURLOPT_URL, $api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, 0);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);

        if ($response === FALSE)
        {
            $error = curl_error($curl);
            curl_close($curl);
            return FALSE;
        }
        else
        {
            // 解决windows 服务器 BOM 问题
            $response = trim($response,chr(239).chr(187).chr(191));
            $response = json_decode($response, true);
        }

        curl_close($curl);

        return $response;
    }
}
if (! function_exists('httpCurl')) {
//根据微信API获取sessionkey 和 openid
    function httpCurl($url, $params, $method = 'GET', $header = array(), $multi = false)
    {
        date_default_timezone_set('PRC');
        $opts = array(
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_COOKIESESSION => true,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_COOKIE
            => session_name() . '=' . session_id(),
        );
        /* 根据请求类型设置特定参数 */
        switch (strtoupper($method)) {
            case 'GET':
                // 链接后拼接参数  &  非？
                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                break;
            case 'POST':                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                throw new \Exception('不支持的请求方式！');
        }
        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error) throw new \Exception('请求发生错误：' . $error);
        return $data;
    }
}

/**
 * 生成从开始月份到结束月份的月份数组
 * @param int $start 开始时间戳
 * @param int $end 结束时间戳
 */
function monthList($start,$end){
    if(!is_numeric($start)||!is_numeric($end)||($end<=$start)) return '';
    $start=date('Y-m',$start);
    $end=date('Y-m',$end);
    //转为时间戳
    $start=strtotime($start.'-01');
    $end=strtotime($end.'-01');
    $i=0;//http://www.scutephp.com/
    $d=array();
    while($start<=$end){
        //这里累加每个月的的总秒数 计算公式：上一月1号的时间戳秒数减去当前月的时间戳秒数
        $d[$i]=trim(date('Y-m',$start),' ');
        $start+=strtotime('+1 month',$start)-$start;
        $i++;
    }
    return $d;
}

/**
 * 视频上传
 * @param $file 视频文件
 * @param $folder 文件夹名称
 * @param $file_prefix  文件夹名称
 * @param bool $max_width
 * @return array
 */
function uploadVideo($file, $folder, $file_prefix, $max_width = false)
{
    // 构建存储的文件夹规则，值如：uploads/images/video/201709/21/
    // 文件夹切割能让查找效率更高。
    $folder_name = "uploads/$folder/" . date("Y/m/d", time());

    // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
    // 值如：/home/vagrant/Code/changan/public/uploads/video/201709/21/
    $upload_path = public_path() . '/' . $folder_name;

    // 获取文件的后缀名，因视屏上传时后缀名为空，所以此处确保后缀一直存在
    $extension = strtolower($file->getClientOriginalExtension()) ?: 'mp4';

    // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
    // 值如：1_1493521050_7BVc9v.mp4
    $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

    // 将视频移动到我们的目标存储路径中
    $file->move($upload_path, $filename);

    return [
        'path' => "/$folder_name/$filename",
    ];
}

//获取表所有字段
function get_table_columns($table, $field='')
{
    $res = \Illuminate\Support\Facades\Schema::getColumnListing($table);
    if($field != '')
    {
        //判断字段是否在表里面
        if(in_array($field, $res))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    return $res;
}

//将栏目列表生成数组
function get_category($modelname, $parent_id=0, $pad=0)
{
    $arr = array();

    $temp = \DB::table($modelname)->where('pid', $parent_id);
    $temp = $temp->orderBy('id', 'asc');
    $temp = $temp->get();

    $cats = object_to_array($temp);
    if($cats)
    {
        foreach($cats as $row)//循环数组
        {
            $row['deep'] = $pad;

            if($child = get_category($modelname, $row["id"], $pad+1))//如果子级不为空
            {
                $row['child'] = $child;
            }

            $arr[] = $row;
        }

        return $arr;
    }
}

function category_tree($list,$pid=0)
{
    global $temp;

    if(!empty($list))
    {
        foreach($list as $v)
        {
            $temp[] = array("id"=>$v['id'],"deep"=>$v['deep'],"name"=>$v['name'],"pid"=>$v['pid']);
            //echo $v['id'];
            if(array_key_exists("child",$v))
            {
                category_tree($v['child'],$v['pid']);
            }
        }
    }

    return $temp;
}


function array_unique_new($arr){

    $t = array_map('serialize', $arr);//利用serialize()方法将数组转换为以字符串形式的一维数组

    $t = array_unique($t);//去掉重复值

    $new_arr = array_map('unserialize', $t);//然后将刚组建的一维数组转回为php值

    return $new_arr;

}

/**
 * 图片上传
 * @param $file 图片文件
 * @param $folder 文件夹名称
 * @param $file_prefix  文件夹名称
 * @param bool $max_width
 * @return array
 */
function uploadImage($file, $folder, $file_prefix, $max_width = false)
{

    // 构建存储的文件夹规则，值如：uploads/images/video/201709/21/
    // 文件夹切割能让查找效率更高。
    $folder_name = "uploads/$folder/" . date("Y").'/'.date('m').'/'.date('Ymd');

    // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
    // 值如：/home/vagrant/Code/changan/public/uploads/video/201709/21/
    $upload_path = public_path() . '/' . $folder_name;

    // 获取文件的后缀名，因视屏上传时后缀名为空，所以此处确保后缀一直存在
    $extension = strtolower($file->getClientOriginalExtension()) ?: 'jpg';

    // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
    // 值如：1_1493521050_7BVc9v.mp4
    $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

    // 将视频移动到我们的目标存储路径中
    $file->move($upload_path, $filename);

    return [
        'path' => "$folder_name/$filename",
    ];
}
