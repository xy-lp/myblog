<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="place">
    <span>添加用户</span>

    </div>
    
    <div class="formbody">
    <form name="form1" method="post" action="<?php echo U('User/user_add');?>">
    <div class="formtitle"><span>基本信息</span></div>
    
    <ul class="forminfo">
	<li><label>昵称</label><input name="us_realname" type="text" class="dfinput" /><i></i></li>
    <li><label>用户名</label><input name="us_username" type="text" class="dfinput" /><i></i></li>

   <li><label>密码</label><input name="us_password" type="password" class="dfinput" value="" /><i></i></li>
   <li><label>重复密码</label><input name="repassword" type="password" class="dfinput" value="" /><i></i></li>
   	<li><label>用户组</label>
	<select name="us_role_id">
	
	<?php if(is_array($info)): foreach($info as $key=>$vo): ?><option value="<?php echo ($vo["re_id"]); ?>"><?php echo ($vo["re_name"]); ?></option><?php endforeach; endif; ?>
	</select>
	</li>
    <li><label>开启状态</label><cite><input name="us_lock" type="radio" value="1" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="us_lock" type="radio" value="0" />否</cite></li>
   
    <li><label>&nbsp;</label><input name="button" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    
    </form>
    </div>


</body>

</html>