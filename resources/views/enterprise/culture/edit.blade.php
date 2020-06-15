<script src="<?php echo route('home'); ?>/js/jquery-3.3.1.min.js"></script><!--需要引入jquery-->
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/froala_editor.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/froala_style.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/code_view.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/draggable.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/colors.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/emoticons.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/image_manager.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/image.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/line_breaker.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/table.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/char_counter.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/video.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/fullscreen.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/file.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/quick_insert.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/help.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/third_party/spell_checker.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/plugins/special_characters.css">
<link rel="stylesheet" href="<?php echo route('home'); ?>/froala_editor/css/codemirror.min.css">
<style>
    .fr-wrapper:nth-child(2){
        display: none;
    }
    body {
        text-align: center;
    }

</style>

<script type="text/javascript"
        src="<?php echo route('home'); ?>/froala_editor/js/codemirror.min.js"></script>
<script type="text/javascript"
        src="<?php echo route('home'); ?>/froala_editor/js/xml.min.js"></script>

<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/froala_editor.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/align.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/char_counter.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/code_beautifier.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/code_view.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/colors.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/draggable.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/emoticons.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/entities.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/file.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/font_size.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/font_family.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/fullscreen.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/image.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/image_manager.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/line_breaker.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/inline_style.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/link.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/lists.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/paragraph_format.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/paragraph_style.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/quick_insert.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/quote.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/table.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/save.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/url.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/video.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/help.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/print.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/third_party/spell_checker.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/special_characters.min.js"></script>
<script type="text/javascript" src="<?php echo route('home'); ?>/froala_editor/js/plugins/word_paste.min.js"></script>
<script type="text/javascript" src='<?php echo route('home'); ?>/froala_editor/js/languages/zh_cn.js'></script>
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
                                <a href="{{env('APP_URL')}}/{{$info->image}}" target="view_window">
                                    <img alt="image" src="{{env('APP_URL')}}/{{$info->image}}" style="width: 80px">
                                </a>
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

                        <div class="form-group"><label class="col-sm-2 control-label required">购物链接</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="link" value="{{$info->link}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div id="editor">
                            <textarea id="edit" name="body">{{$info->body}}</textarea>
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
        (function() {
            new FroalaEditor('#edit',{
                key: '',
                language: 'zh_cn',
                height: 300,
                dragInline:false,


                // disable quick insert
                quickInsertTags: [],

                // toolbar buttons
                //文件上传按钮 'insertFile',
                toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', '|', 'paragraphFormat', 'fontSize', 'color', '|', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', '-', 'insertLink',  'insertImage', 'insertVideo', 'embedly', 'insertTable', '|', 'insertHR', 'selectAll', 'clearFormatting', '|', 'spellChecker', 'help', 'html', '|', 'undo', 'redo'],

                // upload file
                {{--fileUploadParam: 'file',--}}
                {{--fileUploadURL: '{{route('upload_file')}}',--}}
                {{--fileUploadMethod: 'POST',--}}
                {{--fileMaxSize: 20 * 1024 * 1024,--}}
                {{--fileAllowedTypes: ['*'],--}}

                // upload image
                imageUploadParam: 'file',
                imageUploadURL: '{{route('upload_img')}}',
                imageUploadMethod: 'POST',
                imageMaxSize: 5 * 1024 * 1024,
                imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'svg+xml'],

                // upload video
                videoWidth: 500,
                videoResponsive: true,
                videoUploadParam: 'file',
                videoUploadURL: '{{route('upload_video')}}',
                videoUploadMethod: 'POST',
                videoMaxSize: 50 * 1024 * 1024,
                videoAllowedTypes: ['avi', 'mov', 'mp4', 'm4v', 'mpeg', 'mpg', 'wmv', 'ogv'],

            })
        })()
    </script>
@endsection
