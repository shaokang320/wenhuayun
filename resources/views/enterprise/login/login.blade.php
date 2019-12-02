<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>联翼互动文化云 | Login</title>
    <link href="<?php echo route('home'); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo route('home'); ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo route('home'); ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo route('home'); ?>/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name" style="font-size: 90px;">&nbsp;</h1>
        </div>
        <div>
            <h1 class="logo-name" style="font-size: 90px;"> &nbsp;</h1>
        </div>
        <h3>联翼互动文化云</h3>
        <p>&nbsp</p>
        <form class="m-t" role="form" method="post" action="{{route('enterprise_dologin')}}" enctype="multipart/form-data">{{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
        </form>
        <p class="m-t"> <small>青岛新高度信息科技有限公司 技术支持</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo route('home'); ?>/js/jquery-2.1.1.js"></script>
<script src="<?php echo route('home'); ?>/js/bootstrap.min.js"></script>

</body>

</html>
