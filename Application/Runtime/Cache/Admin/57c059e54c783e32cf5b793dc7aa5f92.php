<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/admin/js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $(".click").click(function(){
  $(".tip").fadeIn(200);
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

});
</script>
 <style type="text/css">
.page{font:13px/1.5 verdana,arial;height:22px;margin-top:20px;text-align:center;}
.page-inner{display:inline-block;}
.page a,.current,.page .page-inner span{float:left;padding:0 8px;text-decoration:none;line-height:22px;height:22px;overflow:hidden;margin:0 1px;}
.page a{color:#2084c6;background:#F0F3F9;border:1px #CCDDDD solid;}
.page a:hover{background:#666;color:#fff;border:1px #636363 solid;}
.page .current{background:#2084c6;color:#fff;border:1px solid #2084c6;}
.page span{float:left;padding:0 8px;text-decoration:none;line-height:22px;height:22px;overflow:hidden;margin:0 1px;}
        </style>

</head>



<body>

<div class="place">
    <span>分类列表</span>

</div>

<div class="formbody">

    <div id="usual1" class="usual">

        <div class="itab">
            <ul>
                <li><a href="#tab2"  class="selected" >分类列表</a></li>
            </ul>
        </div>


    <div id="tab2" class="tabson">
        <table class="tablelist">
            <thead>
            <tr>
                <th></th>
                <th>编号<i class="sort"><img src="/Public/admin/images/px.gif" /></i></th>
                <th>组名称</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
                    <td></td>
                    <td><?php echo ($v["id"]); ?></td>
                    <td><?php echo ($v["title"]); ?></td>
                    <td>
                        <a href="<?php echo U('category/editcategory',array('id'=>$v['id']));?>" class="tablelink"> 修改</a>
                        <a href="<?php echo U('category/delcategory',array('id'=>$v['id']));?>"  onclick="if(confirm('确定删除！')==false)return false;" class="tablelink">删除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>

    <div class="tip">
        <div class="tiptop"><span>提示信息</span><a></a></div>

        <div class="tipinfo">
            <span><img src="/Public/admin/images/ticon.png" /></span>
            <div class="tipright">
                <p>是否确认对信息的修改 ？</p>
                <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
            </div>
        </div>

        <div class="tipbtn">
            <input name="" type="button"  class="sure" value="确定" />&nbsp;
            <input name="" type="button"  class="cancel" value="取消" />
        </div>

    </div>

    <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>

</div>

</body>
</html>