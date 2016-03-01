<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="place">
    <span>添加角色</span>

    </div>
    
    <div class="formbody">
    <form name="form1" method="post" action="<?php echo U('Role/role_add');?>">
    <div class="formtitle"><span>基本信息</span></div>
    
    <ul class="forminfo">
    <li><label>角色名称</label><input name="re_name" type="text" class="dfinput" /><i>标题不能超过30个字符</i></li>
    <li><label>开启状态</label><cite><input name="re_status" type="radio" value="1" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="re_status" type="radio" value="0" />否</cite></li>
    <li><label>&nbsp;</label><input name="button" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>


</body>

</html>