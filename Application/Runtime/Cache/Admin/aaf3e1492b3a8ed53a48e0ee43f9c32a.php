<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>月哥哥国际后援会</title>
<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body style="background:#f0f9fd;">
<div class="lefttop"><span></span>YP-Love</div>
<dl class="leftmenu">
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd><div class="title"><span><img src="/Public/admin/images/leftico04.png" /></span><?php echo ($vo["ru_name"]); ?></div>
            <ul class="menuson">
                <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if($vo['ru_id'] == $vo1['ru_pid']): ?><li><cite></cite><a href="/index.php/<?php echo ($vo1["ru_url"]); ?>" target="rightFrame"><?php echo ($vo1["ru_name"]); ?></a><i></i></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </dd><?php endforeach; endif; else: echo "" ;endif; ?>

        <!--<dd><div class="title"><span><img src="/Public/admin/images/leftico03.png" /></span>博客管理</div>
            <ul class="menuson">

                        <li><cite></cite><a href="/index.php/Admin/Blog/bg_add" target="rightFrame">发表博客</a><i></i></li>
                        <li><cite></cite><a href="/index.php/Admin/Blog/bg_list" target="rightFrame">博客列表</a><i></i></li>
                        <li><cite></cite><a href="/index.php/Admin/Category/cat_list" target="rightFrame">分类列表</a><i></i></li>
                        <li><cite></cite><a href="/index.php/Admin/Category/cat_add" target="rightFrame">添加分类</a><i></i></li>


            </ul>
        </dd>

        <dd><div class="title"><span><img src="/Public/admin/images/leftico01.png" /></span>用户管理</div>
            <ul class="menuson">

                <li><cite></cite><a href="/index.php/Admin/User/user_list" target="rightFrame">用户列表</a><i></i></li>
                <li><cite></cite><a href="/index.php/Admin/User/user_add" target="rightFrame">添加用户</a><i></i></li>
                <li><cite></cite><a href="/index.php/Admin/User/edit_pwd" target="rightFrame">修改密码</a><i></i></li>
                <li><cite></cite><a href="/index.php/Admin/Role/role_list" target="rightFrame">角色列表</a><i></i></li>
                <li><cite></cite><a href="/index.php/Admin/Role/role_add" target="rightFrame">添加角色</a><i></i></li>
            </ul>
        </dd>

        <dd><div class="title"><span><img src="/Public/admin/images/leftico02.png" /></span>模版管理</div>
            <ul class="menuson">

                <li><cite></cite><a href="/index.php/<?php echo ($vo2["url"]); ?>" target="rightFrame">模版列表</a><i></i></li>

            </ul>
        </dd>

        <dd><div class="title"><span><img src="/Public/admin/images/leftico04.png" /></span>权限管理</div>
            <ul class="menuson">

                <li><cite></cite><a href="/index.php/Admin/Rule/rule_list" target="rightFrame">权限列表</a><i></i></li>
                <li><cite></cite><a href="/index.php/Admin/Rule/rule_add" target="rightFrame">添加权限</a><i></i></li>

            </ul>
        </dd>

        <dd><div class="title"><span><img src="/Public/admin/images/leftico05.png" /></span>系统管理</div>
            <ul class="menuson">

                <li><cite></cite><a href="/index.php/Admin/System/export_data" target="rightFrame">导出数据</a><i></i></li>

            </ul>
        </dd>-->

</dl>

<script language="JavaScript" src="/Public/admin/js/jquery.js"></script>

<script type="text/javascript">
    $(function(){
        //导航切换
        $(".menuson .header").click(function(){
            var $parent = $(this).parent();
            $(".menuson>li.active").not($parent).removeClass("active open").find('.sub-menus').hide();

            $parent.addClass("active");
            if(!!$(this).next('.sub-menus').size()){
                if($parent.hasClass("open")){
                    $parent.removeClass("open").find('.sub-menus').hide();
                }else{
                    $parent.addClass("open").find('.sub-menus').show();
                }


            }
        });

        // 三级菜单点击
        $('.sub-menus li').click(function(e) {
            $(".sub-menus li.active").removeClass("active")
            $(this).addClass("active");
        });

        $('.title').click(function(){
            var $ul = $(this).next('ul');
            $('dd').find('.menuson').slideUp();
            if($ul.is(':visible')){
                $(this).next('.menuson').slideUp();
            }else{
                $(this).next('.menuson').slideDown();
            }
        });
    })
</script>
</body>
</html>