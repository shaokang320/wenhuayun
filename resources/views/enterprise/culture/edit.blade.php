<script src="<?php echo route('home'); ?>/js/jquery-3.3.1.min.js"></script><!--需要引入jquery-->
@extends('enterprise.layouts.app')
@section('title', '企业文化修改')
<meta name="csrf-token" content="{{ csrf_token() }}"><!--需要csrf token-->
@section('content')
    <h5 class="sub-header">企业文化修改</h5>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form id="addarc" method="post" action="{{route('enterprise_culture_doedit')}}" role="form" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label required">标题</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="title" value="{{$info->title}}">
                                <input type="hidden" name="id" value="{{$id}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">缩略图</label>
                            <div class="col-sm-4">
                                <input type="file" name="img"/>
                                <img src="{{env('APP_URL')}}/{{$info->image}}"/>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group" id="aetherupload-wrapper"><label class="col-sm-2 control-label">上传视频</label>
                            <div class="col-sm-4">
                                <div class="controls">
                                    <input type="file" id="aetherupload-resource" onchange="aetherupload(this).upload()"/>
                                    <div class="progress " style="height: 6px;margin-bottom: 2px;margin-top: 10px;width: 200px;">
                                        <div id="aetherupload-progressbar" style="background:blue;height:6px;width:0;"></div>
                                    </div>
                                    <span style="font-size:12px;color:#aaa;" id="aetherupload-output"></span>
                                    <input type="hidden" name="video" id="aetherupload-savedpath">
                                </div>
                            </div>
                        </div>
                    {{ csrf_field() }} <!--需要标识csrf token的field-->
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">文字介绍</label>
                            <div class="col-sm-4">
                                <textarea type="text" rows="6" class="form-control required" name="body">{{$info->body}}</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <button type="submit" class="btn btn-success" value="Submit">保存(Submit)</button>&nbsp;&nbsp;<button type="reset" class="btn btn-default" value="Reset">重置(Reset)</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- 表单结束 -->
    <script src="{{ URL::asset('vendor/aetherupload/js/spark-md5.min.js') }}"></script><!--需要引入spark-md5.min.js，用以支持秒传功能-->
    <script src="{{ URL::asset('vendor/aetherupload/js/aetherupload.js') }}"></script><!--需要引入aetherupload.js-->
    <script>
        // success(someCallback)中声名的回调方法需在此定义，参数someCallback可为任意名称，此方法将会在上传完成后被调用
        // 可使用this对象获得resourceName,resourceSize,resourceTempBaseName,resourceExt,groupSubdir,group,savedPath等属性的值
        someCallback = function () {
            // Example
            $('#result').append(
                '<p>执行回调 - 文件已上传，原名：<span >' + this.resourceName + '</span> | 大小：<span >' + parseFloat(this.resourceSize / (1000 * 1000)).toFixed(2) + 'MB' + '</span> | 储存名：<span >' + this.savedPath.substr(this.savedPath.lastIndexOf('_') + 1) + '</span></p>'
            );
        }
        $(function(){
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
