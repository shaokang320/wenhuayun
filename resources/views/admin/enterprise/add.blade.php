@extends('admin.layouts.app')
@section('title', '企业添加')
@section('content')
<h5 class="sub-header">企业添加</h5>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <form id="addarc" method="post" action="{{route('admin_enterprise_doadd')}}" role="form" enctype="multipart/form-data" class="form-horizontal">{{ csrf_field() }}
                    <div class="form-group"><label class="col-sm-2 control-label required">企业名称</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control required" name="name">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">登录帐号</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="accounts">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">登录密码</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">联系手机</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control required" name="mobile">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">经度</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="longitude">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">纬度</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control required" name="latitude">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">帐号使用期限</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control required" name="end_time"> 截至日期
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">账号状态 </label>
                        <div class="col-sm-4">
                            <div class="i-checks">
                                <label> <input type="radio" value="0" name="status"> <i></i> 正常 </label>&nbsp;&nbsp;
                                <label> <input type="radio" value="1" name="status"> <i></i> 禁用 </label>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class="col-sm-2 control-label">企业地址</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="address">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <button type="submit" class="btn btn-success" value="Submit">保存(Submit)</button>&nbsp;&nbsp;<button type="reset" class="btn btn-default" value="Reset">重置(Reset)</button>
                </form>
            </div>
        </div>
    </div>
</div><!-- 表单结束 -->
<script>
$(function(){
    // $(".required").blur(function(){
    //     var $parent = $(this).parent();
    //     $parent.find(".formtips").remove();
    //     if(this.value=="")
    //     {
    //         $parent.append(' <small class="formtips onError"><font color="red">不能为空！</font></small>');
    //     }
    //     else
    //     {
    //         $parent.append(' <small class="formtips onSuccess"><font color="green">OK</font></small>');
    //     }
    // });

    //重置
    $('#addarc input[type="reset"]').click(function(){
            $(".formtips").remove();
    });

    $("#addarc").submit(function(){
        $(".required").trigger('blur');
        var numError = $('#addarc .onError').length;

        if(numError){return false;}
    });
});
</script>
@endsection
