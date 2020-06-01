@extends('admin.layouts.app')
@section('title', 'banner列表')
@section('content')
    <link href="<?php echo route('home'); ?>/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <style>
        .del{
            background: rgba(0,0,0,.3);
            color:#fff;
            display:inline-block;
            line-height: 20px;
            text-align:center;
            width: 20px;
            height:20px;
            font-size: 16px;
            font-weight:bold;
            /*position: absolute;*/
            top: 0;
            right: 0;
        }
    </style>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="file-manager">
                            <h5>上传格式:</h5>
                            <a href="#" class="file-control">png</a>
                            <a href="#" class="file-control">jpg</a>
                            <a href="#" class="file-control">jpeg</a>
                            <a href="#" class="file-control">gif</a>
                            <div class="hr-line-dashed"></div>
                            <button class="btn btn-primary btn-block" onclick="upImage();">上传图片</button>
                            <div class="hr-line-dashed"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        var _editor2;
                        $(function () {
                            //重新实例化一个编辑器，防止在上面的editor编辑器中显示上传的图片或者文件
                            _editor2 = UE.getEditor('ueditordimg');
                            _editor2.ready(function () {
                                //设置编辑器不可用
                                _editor2.setDisabled('insertimage');
                                //隐藏编辑器，因为不会用到这个编辑器实例，所以要隐藏
                                _editor2.hide();
                                //侦听图片上传
                                _editor2.addListener('beforeInsertImage', function (t, arg) {
                                    $("#duotulist").html('<button type="button" onclick="upImage();">选择图片</button>');
                                    for (var i = 0; i < arg.length; i++) {
                                        if (i < 8) {
                                            $(".lightBoxGallery").append('<span><a href="' + arg[i].src + '" title="" data-gallery="">' +
                                                '<img style="margin-left:10px;" src="' + arg[i].src + '" width="300" height="150">' +
                                                '<span class="del" onClick="remove_specli(this);">X</span>'+
                                                '<input name="banner_img[]" type="text" value="' + arg[i].src + '" style="display:none;"></a></span>');
                                        }
                                    }
                                })
                            });
                        });

                        //弹出图片上传的对话框
                        function upImage() {
                            var myImage = _editor2.getDialog("insertimage");
                            myImage.render();
                            myImage.open();
                        }
                    </script>
                    <script type="text/plain" id="ueditordimg"></script>
                </div>
            </div>
            <form id="addarc" method="post" action="{{route('admin_banner')}}" role="form" enctype="multipart/form-data"
                  class="table-responsive">{{ csrf_field() }}
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="lightBoxGallery">
                                @if ($bannerInfo)
                                    <input name="banner_id" type="hidden" value="{{$bannerInfo->banner_id}}" >
                                    @foreach ($bannerInfo->banner_img as $k => $v)
                                        <span>
                                            <a href="{{$v}}" title="" data-gallery="">
                                                <img style="margin-left:10px;" src="{{$v}}" width="300" height="150">
                                                <input name="banner_img[]" type="text" value="{{$v}}" style="display:none;">
                                            </a>
                                            <span class="del" onClick="remove_specli(this);">X</span>
                                        </span>
                                    @endforeach
                                @else
                                    <input name="banner_id" type="hidden" value="" >
                                @endif

                            </div>
                            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                            <div id="blueimp-gallery" class="blueimp-gallery">
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <button class="btn btn-primary btn-block" type="submit" style="width: 20%">保存</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- 配置文件 -->
    <script type="text/javascript" src="<?php echo route('home'); ?>/other/flueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="<?php echo route('home'); ?>/other/flueditor/ueditor.all.min.js"></script>
    <!-- blueimp gallery -->
    <script src="<?php echo route('home'); ?>/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
    <script>
        function remove_specli(e) {
            $(e).parent().remove()
        }
    </script>
@endsection
