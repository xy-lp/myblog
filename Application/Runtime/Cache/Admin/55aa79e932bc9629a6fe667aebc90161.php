<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>月哥哥~</title>
<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/admin/css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/admin/js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/select-ui.min.js"></script>

  
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
});
</script>
<script type="text/javascript">  
       function checkAll(field){  
         var checkboxes = document.getElementsByName("wid[]");  
         for(var i=0;i<checkboxes.length;i++){  
             checkboxes[i].checked = field.checked;  
          }  
      }  
      
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
    <span>博客列表</span>
  
    </div>
    
    <div class="formbody">
    
    
    <div id="usual1" class="usual"> 
    
    <div class="itab">
  	<ul> 
   
    <li><a href="#tab2"  class="selected" >博客列表</a></li> 
  	</ul>
    </div> 
    
    
    
  	<div id="tab2" class="tabson">
    
    <form name="form2" method="post" action="">
    <ul class="seachform">
    <li><label>标题</label><input name="bg_title" type="text" class="scinput" /></li>
    <li><label>分类</label>  
    <div class="vocation">
     <select class="select3" name="cat_id">
	 <option value="">全部</option>
     <?php if(is_array($catedata)): $i = 0; $__LIST__ = $catedata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['cat_id'] == $id): ?><option value="<?php echo ($vo["cat_id"]); ?>" selected="selected"><?php echo ($vo["cat_name"]); ?></option>
         <?php else: ?>
             <option value="<?php echo ($vo["cat_id"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </select>
    </div>
    </li>
    <li><label>&nbsp;</label><input name="button" type="submit" class="scbtn" value="查询"/></li>
    </ul>
    </form>
    <form name="form1" method="post" action="<?php echo U('Admin/Content/delall');?>">
    <table class="tablelist">
    	<thead>
    	<tr>
        <th><input id="allchecked"  type="checkbox" class="ckbox" value="" /></th>
        <th>编号<i class="sort"><img src="/Public/admin/images/px.gif" /></i></th>
        <th>标题</th> 
        <th>作者</th>
		 <th>分类</th>
        <th>发布时间</th>
        <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
 foreach($blogdata as $v){ ?>
            <tr>
            <td><input name="bg_id" class="ckbox1" type="checkbox" value="<?php echo $v['bg_id']?>" /></td>
            <td><?php echo $v['bg_id']?></td>
            <td><a href="" target="_bank" class="tablelink"><?php echo $v['bg_title']?></a> </td>
            <td><?php echo $v['bg_author']?></td>
            <td value="<?php echo $v['cat_id']?>"><?php echo $v['cat_name']?></td>
            <td><?php echo date($v['bg_time'],date('Y-m-d H:i:s'))?></td>
            <td>
                <a href="" target="_bank" class="tablelink">查看</a>
                <a href="<?php echo U('bg_edit',array('bg_id'=>$v['bg_id']))?>" class="tablelink"> 修改</a>
                <a href="<?php echo U('bg_del',array('bg_id'=>$v['bg_id']))?>"  onclick="if(confirm('确定删除！')==false)return false;" class="tablelink">删除</a>
            </td>
            </tr>

        <?php
 } ?>
        
        </tbody>
    </table>
    </form>
        <!-- page  -just-2015/02/29 -->
        <div class="pagin">
    <div class="message">共<i class="blue"><?php echo ($page["count"]); ?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo ($page["page_id"]); ?>&nbsp;</i>页</div>
    <ul class="paginList">
        <li class="paginItem"><a href="/index.php/Admin/Blog/bg_list/page_id/<?php echo $page['page_id']-1?>"><span class="<?php echo $page['page_id']==1?'pagepre':'pagenxt';?>"></span></a></li>
        <?php for($i=1;$i<=$page['page_count'];$i++){?>
        <li class="paginItem <?php if($page['page_id']==$i) echo 'current'?>"><a href="/index.php/Admin/Blog/bg_list/page_id/<?php echo $i?>"><?php echo $i?></a></li>
        <?php }?>
        <li class="paginItem"><a href="/index.php/Admin/Blog/bg_list/page_id/<?php echo $page['page_id']+1?>"><span class="<?php echo $page['page_id']==$page['page_count']?'pagepre':'pagenxt';?>"></span></a></li>
    </ul>
</div>
        <!-- page End -->
    </div>
	</div>

    <script type="text/javascript" src="/Public/admin/js/admin/check.js"></script>
 
	<script type="text/javascript"> 
      $("#usual1 ul").idTabs(); 
    </script>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>

    </div>
</body>

</html>