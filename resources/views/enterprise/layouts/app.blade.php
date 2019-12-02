<!DOCTYPE html>
<html>
<head><title>联翼互动文化云</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php echo route('home'); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo route('home'); ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?php echo route('home'); ?>/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo route('home'); ?>/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="<?php echo route('home'); ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo route('home'); ?>/css/style.css" rel="stylesheet">
    <!-- Mainly scripts -->

    <script src="<?php echo route('home'); ?>/js/jquery-2.1.1.js"></script>
    <script src="<?php echo route('home'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo route('home'); ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo route('home'); ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo route('home'); ?>/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo route('home'); ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo route('home'); ?>/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo route('home'); ?>/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo route('home'); ?>/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="<?php echo route('home'); ?>/js/plugins/peity/jquery.peity.min.js"></script>

    <!-- Custom and physique javascript -->
    <script src="<?php echo route('home'); ?>/js/inspinia.js"></script>
    <script src="<?php echo route('home'); ?>/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo route('home'); ?>/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="<?php echo route('home'); ?>/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo route('home'); ?>/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo route('home'); ?>/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?php echo route('home'); ?>/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="<?php echo route('home'); ?>/js/plugins/toastr/toastr.min.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu " id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img style="width: 80%;" alt="image" class="img-circle" src="<?php echo route('home'); ?>/img/logo.png" />
                        </span>
                    </div>
                </li>
                <li class="item">
                    <a href="<?php echo route('admin');?>"><i class="fa fa-home"></i> <span class="nav-label">首页</span></a>
                </li>
                <li class="item">
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">产品管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="">产品列表</a></li>
                        <li><a href="">产品添加</a></li>
                    </ul>
                </li>
                <li class="item">
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">文化管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="{{route('enterprise_culture')}}">文化列表</a></li>
                        <li><a href="{{route('enterprise_culture_add')}}">文化添加</a></li>
                    </ul>
                </li>
                <li class="item">
                    <a href="<?php echo route('admin');?>"><i class="fa fa-users"></i> <span class="nav-label">企业信息</span> </a>
                </li>
            </ul>
            <script>
                const url = String(window.location);
                $('#side-menu .item').each(function() {
                    $(this).find('.nav-second-level li').each(function() {
                        var current = $(this).find('a');
                        if (current.attr('href') == url) {
                            current.parent().parent().children().removeClass('active')
                            current.parent().addClass('active')
                            current.parent().parent().parent().addClass('active')
                        }
                    });
                });
            </script>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">欢迎使用联翼互动文化云后台管理系统</span>
                    </li>

                    <li>
                        <a class="right-sidebar-toggle">
                            <i class="fa fa-tasks"></i>
                        </a>
                    </li>
                </ul>
                <div id="right-sidebar">
                    <div class="sidebar-container">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="sidebar-message">
                                    <a href="">
                                        <i class="fa fa-sign-out"></i> 密码修改
                                    </a>
                                </div>
                                <div class="sidebar-message">
                                    <a href="">
                                        <i class="fa fa-sign-out"></i> Log out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        @yield('content')
    </div>
</div>

</body>
</html>
