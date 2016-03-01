<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="place">
    <span>添加栏目</span>

    </div>
    
    <div class="formbody">
    <form name="form1" method="post" action="<?php echo U('Rule/rule_add');?>">
    <div class="formtitle"><span>基本信息</span></div>
    
    <ul class="forminfo">
    <li><label>栏目名称</label><input name="ru_name" type="text" class="dfinput" /><i>标题不能超过30个字符</i></li>
   <li><label>URL地址</label><input name="ru_url" type="text" class="dfinput" value="" /><i>例：Admin/User/rule_add</i></li>
    <li><label>上级栏目</label>
        <select name="ru_pid">
            <option value="0">--顶级目录--</option>
            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><option value="<?php echo ($vo["ru_id"]); ?>">--<?php echo ($vo["ru_name"]); ?></option><?php endforeach; endif; ?>
        </select>
    </li>
    <li><label>开启状态</label><cite><input name="ru_status" type="radio" value="1" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="status" type="radio" value="0" />否</cite></li>
   <li><label>排序</label><input name="ru_order" type="text" class="dfinput" value="50"/></li>
    <li><label>&nbsp;</label><input name="button" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    
    </form>
    </div>


</body>

</html>