<?php
namespace App\Http\Requests;

class EnterpriseRequest extends BaseRequest
{
    //总的验证规则
    protected $rules = [
        'name'          => 'required|max:50',
        'accounts'      => 'required|max:50',
        'password'      => 'required|max:32',
        'mobile'        => 'required|max:15',
        'longitude'     => 'required|max:50',
        'latitude'      => 'required|max:50',
        'qrCode'        => 'max:150',
        'end_time'      => 'date_format:"Y-m-d H:i:s"',
        'createTime'    => 'required|date_format:"Y-m-d H:i:s"',
        'updateTime'    => 'date_format:"Y-m-d H:i:s"',
        'address'       => 'max:200',
        'status'        => 'integer|between:0,1',
    ];

    //总的自定义错误信息
    protected $messages = [
        'name.required'             => '企业名称必填',
        'name.max'                  => '企业名称长度不能超过50个字符',
        'accounts.required'         => '企业登录帐号必填',
        'accounts.max'              => '企业登录帐号长度不能超过50个字符',
        'password.required'         => '企业登录密码必填',
        'password.max'              => '企业登录密码长度不能超过32个字符',
        'mobile.required'           => '企业联系电话必填',
        'mobile.max'                => '企业联系电话长度不能超过15个字符',
        'longitude.required'        => '经度必填',
        'longitude.max'             => '经度长度不能超过50个字符',
        'latitude.required'         => '纬度必填',
        'latitude.max'              => '纬度长度不能超过50个字符',
        'qrCode.max'                => '二维码长度不能超过150个字符',
//        'end_time.required'         => '帐号使用期限必填',
        'end_time.date_format'      => '帐号使用期限格式不正确',
        'address.max'               => '企业地址长度不能超过200个字符',
        'status.integer'            => '企业帐号状态必须是整数',
        'status.between'            => '企业帐号状态数字0-1',
        'createTime.required'       => '创建时间必填',
        'createTime.date_format'    => '创建时间格式不正确',
        'updateTime.date_format'    => '修改时间格式不正确'
    ];

    //场景验证规则
    protected $scene = [
        'add' => ['name', 'accounts', 'password', 'mobile', 'longitude', 'latitude', 'qrCode',  'address', 'status', 'createTime'],
        'edit' => ['name', 'accounts', 'mobile', 'longitude', 'latitude', 'qrCode', 'end_time', 'address', 'status','updateTime'],
        'del' => ['id'],
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
