<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
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
</head>

<body>

<div class="place">
    <span>添加博客</span>
 
    </div>
    
    <div class="formbody">
    
    
    <div id="usual1" class="usual"> 
    
    <div class="itab">
  	<ul> 
    <li><a href="#tab1" class="selected" >发布博客</a></li> 
    
  	</ul>
    </div> 
    
  	<div id="tab1" class="tabson">
    
   
    <form name="form1" method="post" action="<?php echo U('bg_add')?>" enctype="multipart/form-data">
    <ul class="forminfo">
    <li><label>标题<b>*</b></label><input name="bg_title" type="text" class="dfinput" value=""  style="width:518px;"/></li>
   
     <li><label>作者<b>*</b></label><input name="bg_author" type="text" class="dfinput" value="" size="20" style="width:518px;"/></li>
    
    <li><label>分类<b>*</b></label>
    <div class="vocation">
    <select class="select1" name="cat_id">
        <?php
 foreach($catedata as $v){ ?>
        <option value="<?php echo $v['bg_id']?>" <?php echo $v['bg_id']==$cat_id?'selected':''?>><?php echo str_repeat('--',$v['deep']).$v['cat_name']?></option>
        <?php
 } ?>
    </select>
    </div>
    </li>

    <li><label>描述</label><textarea name="bg_content" cols="" rows="" class="textinput"></textarea><i>(100字以内)</i></li>
	  
    <li><label>设置时间</label><input name="time" type="text" readonly="readonly" class="dfinput" value="<?php echo date("Y-m-d H:i:s"); ?>"  style="width:518px;"/></li>

    <li><label>缩略图</label><input type="file" name="bg_imgpath"/>

    <li><label>内容<b>*</b></label>
<input type="hidden" id="content" name="bg_content" value="" style="display:none"><input type="hidden" id="content___Config" value="" style="display:none">
<iframe id="content___Frame" src="/Public/Admin/fckeditor/editor/fckeditor.html?InstanceName=content&amp;Toolbar=Normal" width="100%" height="320" frameborder="0" scrolling="no" style="margin: 0px; padding: 0px; border: 0px; background-color: transparent; background-image: none; width: 100%; height: 320px;"></iframe>
    </li>

    <li><label>&nbsp;</label><input name="button" type="submit" class="btn" value="马上发布"/></li>
    </ul>
    </form>
    </div>
	</div> 
 
	<script type="text/javascript"> 
      $("#usual1 ul").idTabs(); 
    </script>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
    
    
    
    
    
    </div>


</body>

</html>