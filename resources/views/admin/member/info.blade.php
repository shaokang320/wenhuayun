@extends('admin.layouts.app')
@section('title', '会员详情')

@section('content')
    <h4 class="sub-header"><a href="<?php echo route('admin_member'); ?>">会员列表</a> > 会员信息</h4>
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-sm-4">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="tab-content">
                            <div id="contact-1" class="tab-pane active">
                                <div class="row m-b-lg">
                                    <div class="col-lg-4 text-center">
                                        <h2>@if($post['true_name']){{$post['true_name']}}@else{{$post['name']}}@endif</h2>
                                        <div class="m-b-sm">
                                            <img alt="image" class="img-circle" src="{{$post['avatar']}}" style="width: 62px">
                                        </div>
                                    </div>
                                </div>
                                <div class="client-detail">
                                    <div class="full-height-scroll">
                                        <strong>信息</strong>
                                        <ul class="list-group clear-list">
                                            <li class="list-group-item fist-item">
                                                <span class="pull-right"> {{$post['balance']}} </span>
                                                账户余额
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right"> {{$post['mobile']}} </span>
                                                手机号
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right"> {{$post['cumulative']}} </span>
                                                累计消费金额
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right"> @if($post['sex'] == 0) 男 @elseif($post['sex'] == 1) 女 @else 保密 @endif </span>
                                                会员性别
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right"> {{$post['createTime']}} </span>
                                                创建时间
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <span class="text-muted small pull-right"></span>
                        <h2>档案 </h2><span>只显示最新10条</span>
                        <div class="clients-list">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>会员卡激活记录</a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i>订单列表</a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#tab-3"><i class="fa fa-briefcase"></i>提现记录</a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#tab-4"><i class="fa fa-briefcase"></i>收货地址</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    <th>会员卡id</th>
                                                    <th>卡号</th>
                                                    <th>金额</th>
                                                    <th>余额</th>
                                                    <th>状态</th>
                                                    <th>激活时间</th>
                                                </tr>
                                                @if($activationLog)
                                                    @foreach($activationLog as $v)
                                                    <tr>
                                                        <td>{{$v->memberCard->id}}</td>
                                                        <td>{{$v->memberCard->number}}</td>
                                                        <td>{{$v->memberCard->money}}</td>
                                                        <td>{{$v->memberCard->balance}}</td>
                                                        <td>
                                                            @if($v->memberCard->status == '0')
                                                                未激活
                                                            @elseif($v->memberCard->status == '1')
                                                                已激活
                                                            @elseif($v->memberCard->status == '2')
                                                                无效
                                                            @endif
                                                        </td>
                                                        <td>{{$v->createTime}}</td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan='6'>暂无会员卡信息</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    <th>流水单号</th>
                                                    <th>店铺名称</th>
                                                    <th>订单状态</th>
                                                    <th>支付金额</th>
                                                    <th>订单类型</th>
                                                    <th>支付类型</th>
                                                    <th>创建时间</th>
                                                    <th>操作</th>
                                                </tr>
                                                @if($order)
                                                    @foreach($order as $v)
                                                        <tr>
                                                            <td>{{$v->order_sn}}</td>
                                                            <td>{{$v->shop_name->name}}</td>
                                                            <td>{{$v->status_text['text']}}</td>
                                                            <td>{{$v->pay_money}}</td>
                                                            <td>{{$v->type_text}}</td>
                                                            <td>{{$v->pay_text}}</td>
                                                            <td>{{$v->createTime}}</td>
                                                            <td class="client-status"><a href="?id={{$v->id}}"><span class="label label-primary">详情</span></a></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-3" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    <th>提现单号</th>
                                                    <th>提现金额</th>
                                                    <th>提现状态</th>
                                                    <th>会员备注</th>
                                                    <th>姓名</th>
                                                    <th>创建时间</th>
                                                    <th>操作</th>
                                                </tr>
                                                @if($withdrawal)
                                                    @foreach($withdrawal as $v)
                                                        <tr>
                                                            <td>{{$v->flow_code}}</td>
                                                            <td>
                                                                <a data-toggle="tab" href="#contact-3" class="client-link">{{$v->money}}</a>
                                                            </td>
                                                            <td>{{$v->status_text}}</td>
                                                            <td>{{$v->describe}}</td>
                                                            <td>{{$v->user_name}}</td>
                                                            <td>{{$v->createTime}}</td>
                                                            <td class="client-status"><a href="?id={{$v->id}}"><span class="label label-primary">详情</span></a></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-4" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    <th>id</th>
                                                    <th>收货人</th>
                                                    <th>手机号</th>
                                                    <th>地址详情</th>
                                                    <th>创建时间</th>
                                                </tr>
                                                @if($address)
                                                    @foreach($address as $v)
                                                        <tr>
                                                            <td>{{$v->id}}</td>
                                                            <td>{{$v->true_name}}</td>
                                                            <td>{{$v->mob_phone}}</td>
                                                            <td>{{$v->address}}{{$v->addressName}}{{$v->plate}}</td>
                                                            <td>{{$v->createTime}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
