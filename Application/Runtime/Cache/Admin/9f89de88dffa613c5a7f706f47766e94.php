<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="place">
    <span>修改权限</span>

    </div>
    
    <div class="formbody">
    <form name="form1" method="post" action="<?php echo U('Rule/rule_edit');?>">
    <div class="formtitle"><span>基本信息</span></div>
    
    <ul class="forminfo">
    <li><label>权限名称</label><input name="ru_name" type="text" class="dfinput" value="<?php echo $info['ru_name']?>" /><i>标题不能超过30个字符</i></li>
   <li><label>URL地址</label><input name="ru_url" type="text" class="dfinput" value="<?php echo $info['ru_url']?>" /><i>例：Admin/User/rule_add</i></li>
    <li><label>上级权限</label>
        <select name="ru_pid">
            <option value="0">--顶级权限--</option>
            <?php
 foreach($data as $v){ if($v['ru_id']==$id){ continue; } if($info['ru_pid']==$v['ru_id']){ $sel="selected='selected'"; }else{ $sel=''; } ?>
            <option <?php echo $sel?> value="<?php echo $v['ru_id']?>"><?php echo str_repeat('-',$v['deep']*2).$v['ru_name']?></option>
            <?php
 } ?>

        </select>
        <i>注意:父级默认为"顶级权限"</i>
        </select>
    </li>
    <li><label>开启状态</label><cite><input name="ru_status" type="radio" value="1" <?PHP if($info['ru_status']=='1') echo 'checked=true';?>  />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="ru_status" type="radio" value="0" <?PHP if($info['ru_status']=='0') echo 'checked=true';?> />否</cite></li>
   <li><label>排序</label><input name="ru_order" type="text" class="dfinput" value="<?PHP echo $info['ru_order']?>"/></li>
    <li><label>&nbsp;</label><input name="button" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    <input type="hidden" name="id" value="<?php echo $id?>"/>
    </form>
    </div>


</body>

</html>