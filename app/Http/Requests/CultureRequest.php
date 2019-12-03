<?php
namespace App\Http\Requests;

class CultureRequest extends BaseRequest
{
    //总的验证规则
    protected $rules = [
        'title'         => 'required|max:50',
        'enterprise_id' => 'required|integer',
        'image'         => 'max:200',
        'rotation'      => 'max:50',
        'video_path'    => 'max:200',
        'qrCode'        => 'max:200',
        'createTime'    => 'required|date_format:"Y-m-d H:i:s"',
        'updateTime'    => 'date_format:"Y-m-d H:i:s"',
        'status'        => 'integer|between:0,1',
    ];

    //总的自定义错误信息
    protected $messages = [
        'title.required'            => '企业文化标题必填',
        'title.max'                 => '企业文化标题长度不能超过50个字符',
        'enterprise_id.required'    => '企业id必填',
        'enterprise_id.integer'     => '企业id必须是整数',
        'image.max'                 => '缩略图长度不能超过200个字符',
        'video_path.max'            => '文化视频路径长度不能超过200个字符',
        'qrCode.max'                => '二维码长度不能超过200个字符',
        'status.integer'            => '状态必须是整数',
        'status.between'            => '状态数字0-1',
        'createTime.required'       => '创建时间必填',
        'createTime.date_format'    => '创建时间格式不正确',
        'updateTime.date_format'    => '修改时间格式不正确'
    ];

    //场景验证规则
    protected $scene = [
        'add' => ['title', 'enterprise_id', 'image', 'video_path', 'qrCode', 'status', 'createTime'],
        'edit' => ['title', 'image', 'video_path', 'status','updateTime'],
        'del' => ['id','enterprise_id'],
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //修改为true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     * 获取被定义验证规则的错误消息.
     *
     * @return array
     */
    public function messages()
    {
        return $this->messages;
    }

    //获取场景验证规则
    public function getSceneRules($name, $fields = null)
    {
        $res = array();

        if (!isset($this->scene[$name])) {
            return false;
        }

        $scene = $this->scene[$name];
        if ($fields != null && is_array($fields)) {
            $scene = $fields;
        }

        foreach ($scene as $k => $v) {
            if (isset($this->rules[$v])) {
                $res[$v] = $this->rules[$v];
            }
        }

        return $res;
    }

    //获取场景验证规则自定义错误信息
    public function getSceneRulesMessages()
    {
        return $this->messages;
    }
}
