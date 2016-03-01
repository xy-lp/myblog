<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>月哥哥~</title>
<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="place">
    <span>添加分类</span>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>添加分类</span></div>
<form action="/index.php/Admin/Category/cat_add" method="post">
    <ul class="forminfo">
    <li><label>分类的名称</label><input name="name" id="name" type="text" class="dfinput" /><i class="i_name">名称不能超过15个字符</i></li>
    <li><label>分类的父级</label>
        <select name="pid" id="pid" class="dfinput">
            <option value="0">--顶级分类--</option>

            <?php if(is_array($cat_list)): foreach($cat_list as $key=>$v): ?><option value="<?php echo ($v["cat_id"]); ?>">--<?php echo ($v["cat_name"]); ?>--</option><?php endforeach; endif; ?>

        </select>
        <i>注意:父级默认为"顶级分类"</i>
    </li>
    <li><label>排&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;序</label><input name="sort" id="sort" type="text" value="50" class="dfinput" /><i class="i_sort">排序值默认为"50",且最大不能超过"254"</i></li>
    <li><label>是否显示</label><cite><input name="show" id="show" type="radio" value="1" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="show" type="radio" value="0" />否</cite></li>
    <li><label>&nbsp;</label><input name="btn" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>

<script type="text/javascript" src="/Public/admin/js/jquery.js"></script>

</body>

</html>