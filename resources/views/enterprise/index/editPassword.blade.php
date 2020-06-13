@extends('admin.layouts.app')
@section('title', '密码修改')

@section('content')
    <h5 class="sub-header">密码修改</h5>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form id="addarc" method="post" action="{{route('enterprise_editPwd')}}" role="form" enctype="multipart/form-data" class="form-horizontal">{{ csrf_field() }}
                        <div class="form-group"><label class="col-sm-2 control-label required">原始密码</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="old_password">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">新密码</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="new_password">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">再次输入密码</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="new2_password">
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
