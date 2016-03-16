<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>月哥哥~</title>
<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />

</head>


<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">数据表</a></li>
    <li><a href="#">基本内容</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">

    	<ul class="toolbar">
        <li class="click add"><span><img src="/Public/admin/images/t01.png" /></span>添加</li>
        <li><span><img src="/Public/admin/images/t03.png" /></span>删除</li>
        <li><span><img src="/Public/admin/images/t04.png" /></span>统计</li>
        </ul>

    </div>
    
    
    <table class="tablelist">
    	<thead>
    	<tr>
        <th><input name="" class="ckbox" type="checkbox" value="" /></th>
        <th>ID<i class="sort"><img src="/Public/admin/images/px.gif" /></i></th>
        <th>角色名</th>
        <th>权限</th>
        <th>状态</th>
        <th>操作</th>

        </tr>
        </thead>
        <tbody>

<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
        <td width="5%"><input name="" class="ckbox1" type="checkbox" value="<?php echo ($v["re_id"]); ?>" /></td>
        <td width="5%"><?php echo ($v["re_id"]); ?></td>
        <td width="20%">
            <?php echo ($v["re_name"]); ?>
        </td>
        <td width="40%"><?php echo ($v["ru_names"]); ?></td>
        <td><img src="/Public/admin/images/<?php echo empty($v['re_status'])?'no':'yes';?>.gif" alt=""/></td>
        <td>
            <a href=" /index.php/Admin/Role/get_rule/id/<?php echo ($v["re_id"]); ?>" class="tablelink">分配权限</a>
            <a href=" /index.php/Admin/Role/role_edit/id/<?php echo ($v["re_id"]); ?>" class="tablelink">修改 </a>
            <a href=" /index.php/Admin/Role/role_del/id/<?php echo ($v["re_id"]); ?>" onclick="if(confirm('确定删除！')==false)return false;" class="tablelink"> 删除</a></td>
        </tr><?php endforeach; endif; ?>

        </tbody>
    </table>


        <!-- page  -just-2015/02/29 -->
        <div class="pagin">
    <div class="message">共<i class="blue"><?php echo ($page["count"]); ?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo ($page["page_id"]); ?>&nbsp;</i>页</div>
    <ul class="paginList">
        <li class="paginItem"><a href="/index.php/Admin/Role/role_list/page_id/<?php echo $page['page_id']-1?>"><span class="<?php echo $page['page_id']==1?'pagepre':'pagenxt';?>"></span></a></li>
        <?php for($i=1;$i<=$page['page_count'];$i++){?>
        <li class="paginItem <?php if($page['page_id']==$i) echo 'current'?>"><a href="/index.php/Admin/Role/role_list/page_id/<?php echo $i?>"><?php echo $i?></a></li>
        <?php }?>
        <li class="paginItem"><a href="/index.php/Admin/Role/role_list/page_id/<?php echo $page['page_id']+1?>"><span class="<?php echo $page['page_id']==$page['page_count']?'pagepre':'pagenxt';?>"></span></a></li>
    </ul>
</div>
        <!-- page End -->
    
    </div>

    <script type="text/javascript" src="/Public/admin/js/jquery.js"></script>

    <script type="text/javascript" src="/Public/admin/js/admin/check.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            fade();
            $('.add').bind('click',function(){
                window.location.href="/admin/Role/role_add";
            })
        });

        function fade(){
            $(".click").click(function(){
                //$(".tip").fadeIn(200);
            });

            $(".tiptop a").click(function(){
                $(".tip").fadeOut(200);
            });

            $(".sure").click(function(){
                $(".tip").fadeOut(100);
            });

            $(".cancel").click(function(){
                $(".tip").fadeOut(100);
            });
        }

        function add(){

        }
    </script>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>

</body>

</html>