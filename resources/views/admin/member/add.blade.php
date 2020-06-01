@extends('admin.layouts.app')
@section('title', '会员添加')

@section('content')
<h5 class="sub-header">会员添加</h5>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <form id="addarc" method="post" action="{{route('admin_member_add')}}" role="form" enctype="multipart/form-data" class="form-horizontal">{{ csrf_field() }}
                    <div class="form-group"><label class="col-sm-2 control-label required">会员姓名</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control required" name="member_true_name">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">账户余额</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="member_balance">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">会员积分</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="member_integral">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">联系手机</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control required" name="member_mobile">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">会员等级</label>
                        <div class="col-sm-4">
                            <select name="member_grade" id="member_grade" class="form-control m-b">
                                <?php if($grade){foreach($grade as $k=>$v){ ?>
                                <option value="<?php echo $v->grade_id; ?>"><?php echo $v->grade_name; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">会员性别 </label>
                        <div class="col-sm-4">
                            <div class="i-checks">
                                <label> <input type="radio" value="1" name="member_sex"> <i></i> 男 </label>&nbsp;&nbsp;
                                <label> <input type="radio" value="2" name="member_sex"> <i></i> 女 </label>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">微信号</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="member_weixin">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">上级ID</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="member_superior">
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