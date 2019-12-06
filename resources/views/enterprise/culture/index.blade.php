@extends('enterprise.layouts.app')
@section('title', '企业文化')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <form id="searcharc" class="navbar-form" method="get" action="{{route('enterprise_culture')}}">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="product_name">标题</label>
                            <input type="text" id="product_name" name="title" value="@if(@isset($where['title'])){{$where['title']}} @endif" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="quantity">状态</label>
                            <select name="status" id="status" class="form-control">
                                <option></option>
                                <option value="0" {{@$where['status'] == '0' ? 'selected' :''}}>正常</option>
                                <option value="1" {{@$where['status'] == 1 ? 'selected' :''}}>禁用</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-w-m btn-info">查询</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <table class="footable table table-stripped toggle-arrow-tiny">
                            <thead>
                            <tr>
                                <th data-toggle="true">ID</th>
                                <th data-hide="phone">标题</th>
                                <th data-hide="phone">缩略图</th>
                                <th data-hide="phone">二维码连接</th>
                                <th data-hide="phone">状态</th>
                                <th data-hide="phone">添加时间</th>
                                <th class="text-right" data-sort-ignore="true">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($posts))
                                @foreach ($posts as $vo)
                                    <tr>
                                        <td>
                                            {{$vo->id}}
                                        </td>
                                        <td>
                                            {{$vo->title}}
                                        </td>
                                        <td>
                                            <a href="{{env('APP_URL')}}/{{$vo->image}}" target="view_window">
                                                <img alt="image" src="{{env('APP_URL')}}/{{$vo->image}}" style="width: 62px">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{env('APP_URL')}}{{$vo->qrCode}}" download="{{$vo->title}}">
                                                <img alt="image" src="{{env('APP_URL')}}{{$vo->qrCode}}" style="width: 62px">
                                            </a>
                                        </td>
                                        <td>
                                            @if($vo->status == 0) 正常 @elseif($vo->status == 1) 禁用 @endif
                                        </td>
                                        <td>
                                            {{$vo->createTime}}
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-primary btn-xs" href="{{route('enterprise_culture_edit')}}?id={{$vo->id}}">修改</a>
                                            @if($vo->status == 0)
                                                <a class="label label-danger" onclick="editStatus('{{route('enterprise_culture_editStatus')}}','{{$vo->id}}',1)" href="javascript:;">禁用</a>
                                            @else
                                                <a class="btn btn-primary btn-xs" onclick="editStatus('{{route('enterprise_culture_editStatus')}}','{{$vo->id}}','0')" href="javascript:;">恢复</a>
                                            @endif
                                            <div class="btn-group">
                                                <a class="label label-danger" onclick="delconfirm('{{route('enterprise_culture_del')}}?id={{$vo->id}}')" href="javascript:;">删除</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan='8'>暂无企业文化信息</td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="8">
                                    <ul class="pagination pull-right">{{ $posts->links() }}</ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language="javascript" type="text/javascript" src="<?php echo route('home'); ?>/js/layer/layer.js"></script>
    <script>
        $(function(){
            $('.required').on('focus', function() {
                $(this).removeClass('input-error');
            });

            $("#searcharc").submit(function(e){
                $(this).find('.required').each(function(){
                    if( $(this).val() == "" )
                    {
                        e.preventDefault();
                        $(this).addClass('input-error');
                    }
                    else
                    {
                        $(this).removeClass('input-error');
                    }
                });
            });
        });

        function editStatus(url,id,status)
        {
            if(confirm("确定更改吗"))
            {
                $.post(url, {
                    id: id,
                    status: status,
                    _token :'{{csrf_token()}}'
                }, function (res) {
                    if (res.code == 0) {
                        layer.msg('操作成功');
                        window.location.reload();
                    }
                    else {
                        layer.msg('操作失败');
                        return false;
                    }
                }, 'json');
            }
        }

        //删除确认框
        function delconfirm(url)
        {
            if(confirm("确定删除吗"))
            {
                location.href= url;
            }
        }

    </script>
@endsection
