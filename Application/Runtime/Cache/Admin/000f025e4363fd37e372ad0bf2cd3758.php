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
    <li><a href="#">表单</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>修改分类</span></div>
<form action="/index.php/Admin/Category/cat_update" method="post">
    <ul class="forminfo">
    <li><label>分类的名称</label><input name="name" id="name" type="text" class="dfinput" value="<?php echo $cateinfo['cat_name']?>"/><i class="i_name">名称不能超过15个字符</i></li>
    <li><label>分类的父级</label>
        <select name="pid" id="pid" class="dfinput">
            <option value="0">--顶级分类--</option>
            <?php
 foreach($catedata as $v){ if(in_array($v['cat_pid'],$ids)){ continue; } if($cateinfo['cat_pid']==$v['cat_id']){ $sel="selected='selected'"; }else{ $sel=''; } ?>
                <option <?php echo $sel?> value="<?php echo $v['cat_id']?>"><?php echo str_repeat('-',$v['deep']*2).$v['cat_name']?></option>
            <?php
 } ?>

        </select>
        <i>注意:父级默认为"顶级分类"</i>
    </li>
    <li><label>排&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;序</label><input name="sort" id="sort" type="text" value="<?php echo $cateinfo['cat_sort']?>" class="dfinput" /><i class="i_sort">排序值默认为"50",且最大不能超过"254"</i></li>
    <li><label>是否显示</label><cite><input name="show" id="show" type="radio" value="<?php echo $cateinfo['is_show']?>" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="show" type="radio" value="0" />否</cite></li>
    <li><label>&nbsp;</label><input name="btn" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    <input name="id" type="hidden" value="<?php echo ($id); ?>"/>
    </form>
    </div>

</body>

</html>