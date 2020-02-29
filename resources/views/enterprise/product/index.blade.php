@extends('enterprise.layouts.app')
@section('title', '企业信息设置')
@section('content')
    <h5 class="sub-header">企业信息设置</h5>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form id="addarc" class="form-horizontal" role="form" enctype="multipart/form-data">{{ csrf_field() }}
                        <div class="form-group"><label class="col-sm-2 control-label required">企业名称</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="name" value="{{$info->name}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">登录帐号</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" readonly="readonly" value="{{$info->accounts}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">联系手机</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="mobile" value="{{$info->mobile}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">限制条数</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="rowCount" disabled value="{{$info->rowCount}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">店铺经度</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="longitude" value="{{$info->longitude}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">店铺纬度</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="latitude" value="{{$info->latitude}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">帐号使用期限</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" readonly="readonly" value="{{$info->end_time}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">店铺地址 </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="address" value="{{$info->address}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <button type="button" class="btn btn-success" id="submit">保存(Submit)</button>&nbsp;&nbsp;
                        <button type="reset" class="btn btn-default" value="Reset">重置(Reset)</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- 表单结束 -->
    <script>
        $('#submit').click(function() {
            $.ajax({
                type: "POST",
                url: "{{route('enterprise_product')}}",
                data: $("#addarc").serialize(),
                async: false,
                error: function (request) {
                    alert("服务器错误,请联系管理员...");
                },
                success: function (data) {
                    if (data.code == '0')
                    {
                        alert("修改成功");
                        window.setTimeout("parent.location.reload()",1000);
                    }else{
                        alert(data.msg);
                    }
                }
            })
        })
        $(function(){
            $(".required").blur(function(){
                var $parent = $(this).parent();
                $parent.find(".formtips").remove();
                if(this.value=="")
                {
                    $parent.append(' <small class="formtips onError"><font color="red">不能为空！</font></small>');
                }
                else
                {
                    $parent.append(' <small class="formtips onSuccess"><font color="green">OK</font></small>');
                }
            });

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
