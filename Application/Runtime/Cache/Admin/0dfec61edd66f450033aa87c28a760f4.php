<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">

    <title>月格格</title>
    <!--<meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">-->

    <link href="/Public/admin/css/login/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="/Public/admin/css/login/font-awesome.css?v=4.3.0" rel="stylesheet">

    <link href="/Public/admin/css/login/animate.css" rel="stylesheet">
    <link href="/Public/admin/css/login/style.css?v=2.2.0" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">Y+</h1>

            </div>
            <h3>欢迎使用 Y+</h3>

            <form class="m-t" role="form" action="/index.php/Admin/Login/checkLogin" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>


                <p class="text-muted text-center"> <a href="login.html#"><input type="checkbox" name="remember" value="1">记住密码</a> | <a href="register.html"><small>忘记密码了？</small></a>
                </p>

            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/Public/admin/js/login/jquery-2.1.1.min.js"></script>
    <script src="/Public/admin/js/login/bootstrap.min.js?v=3.4.0"></script>


</body>

</html>