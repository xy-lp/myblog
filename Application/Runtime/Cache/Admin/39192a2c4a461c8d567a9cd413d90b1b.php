<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />

<style type="text/css">
table.imagetable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 0px;
	border-color: #999999;
	border-collapse: collapse;
	
}
table.imagetable th {
	
	border-width: 0px;
	padding: 10px;
	border-style: solid;
	border-color: #999999;
}
table.imagetable td {
	
	border-width: 1px;
	padding: 10px;
	border-style: dashed;
	border-color: #999999;
	
}
</style>
</head>

<body>
<div class="formbody">
   <form action="<?php echo U('Role/get_rule');?>" method="post" name="form1">
 <div class="formtitle"><span>权限管理</span></div>
<table border="0" cellspacing="0" width="70%" class="imagetable" cellpadding="0" align="center">
 <input type="hidden" name="role_id" value="<?php echo ($id); ?>">
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><tr style="background: url(/Public/admin/images/th.gif) repeat-x;">
		<td nowrap=""  colspan="2" align="">
			<input type='checkbox' name='ru_id[]' value='<?php echo ($vo1["ru_id"]); ?>'
			<?php
 foreach($rule as $val){ if($val==$vo1['ru_id']) echo "checked='checked'"; }?>/><?php echo ($vo1["ru_name"]); ?>   </td>
   </tr>
	<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><tr>

		 <?php if($vo1['ru_id'] == $vo2['ru_pid']): ?><td nowrap="" >&nbsp;&nbsp;&nbsp;&nbsp;
			 <input type='checkbox' name='ru_id[]' value='<?php echo ($vo2["ru_id"]); ?>'
			 <?php foreach($rule as $val){ if($val==$vo2['ru_id']) echo "checked='checked'"; }?>/>
			 <?php echo ($vo2["ru_name"]); ?>	</td><?php endif; ?>

     <!--<td nowrap="" >
	   <?php if(is_array($action["child"])): $i = 0; $__LIST__ = $action["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type='checkbox' name='access[]' value='<?php echo ($vo["id"]); ?>'  <?php if(strstr($nod,$vo['id'])): ?>checked='checked'<?php endif; ?>/><?php echo ($vo["title"]); endforeach; endif; else: echo "" ;endif; ?>
	 </td>-->
   </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
   
    </div>
   <tr>
    <td nowrap="" class="TableFooter" colspan="2" align="center">
       <input name="button" type="submit" class="btn" value="确认保存"/>    </td>
   </tr>
</table>
</form>
    
    </div>


</body>

</html>