@extends('enterprise.layouts.app')
@section('title', '首页')

@section('content')
    <h2 class="sub-header">联翼互动文化云企业后台管理中心</h2>
    <p>· 欢迎使用专业的网站管理系统</p>
    <h3>网站基本信息</h3>
    域名/IP：<?php echo $_SERVER["SERVER_NAME"]; ?> | <?php echo $_SERVER["REMOTE_ADDR"]; ?><br>
    运行环境：<?php
    $server_software = explode(' ', $_SERVER['SERVER_SOFTWARE']);
    echo $server_software[0];
    ?><br>
    PHP版本：<?php echo PHP_VERSION; ?><br>
    Laravel版本：{{$laravel_version}}
    <h3>开发人员</h3>
    陈邵康<br><br>
    我们的联系方式：lyhd888888@126.com<br><br>
    &copy; 青岛新高度信息科技有限公司 版权所有
@endsection
