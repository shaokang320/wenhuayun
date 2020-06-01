@extends('admin.layouts.app')
@section('title', '会员列表')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <form id="searcharc" class="navbar-form" method="get" action="{{route('admin_member')}}">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="product_name">会员姓名</label>
                            <input type="text" id="product_name" name="name" value="@if(@isset($where['name'])){{$where['name']}} @endif" placeholder="会员姓名" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="price">手机号</label>
                            <input type="text" id="price" name="mobile" value="@if(@isset($where['mobile'])){{$where['mobile']}} @endif" placeholder="会员手机号" class="form-control">
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
                                <th data-toggle="true">会员ID</th>
                                <th data-hide="phone">会员昵称</th>
                                <th data-hide="phone">手机号</th>
                                <th data-hide="phone">账户余额</th>
                                <th data-hide="phone,tablet" >会员性别</th>
                                <th data-hide="phone">累计消费</th>
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
                                            {{$vo->name}}
                                        </td>
                                        <td>
                                            {{$vo->mobile}}
                                        </td>
                                        <td>
                                            {{$vo->balance}}
                                        </td>
                                        <td>
                                            @if($vo->sex == 0) 男 @elseif($vo->sex == 1) 女 @else 保密 @endif
                                        </td>
                                        <td>
                                            {{$vo->cumulative}}
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-primary btn-xs" href="{{route('admin_member_info')}}?id={{$vo->id}}">详情</a>
                                            <div class="btn-group">
                                                <a class="label label-danger" onclick="delconfirm('/admin/member/del?id={{$vo->id}}')"href="javascript:;">删除</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan='7'>暂无会员信息</td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="7">
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
