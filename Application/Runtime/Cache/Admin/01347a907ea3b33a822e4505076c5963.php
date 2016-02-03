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
<script type="text/javascript">
    /*$(function(){
        $(".btn").bind('click',function(){
            //add();
        });
    });

    function checkForm(){

    }

    function checkForm(){
        var check_error=false;
        $("#cat_name").bind('blur',function(){
            if(!$(this).val() || $(this).val().length>20){
                if(!$(this).val()){
                    $(".i_name").text('分类名称不能为空!').css({color:'red'});
                    check_error=true;
                }else if($(this).val().length>20){
                    $(".i_name").text('分类名称长度应在0~20之间!').css({color:'red'});
                    check_error=true;
                }
            } else{
                $(".i_name").html('正确').css({color:''});
            }
        });
        $("#sort").bind('blur',function(){
            if(!$(this).val()){
                $(".i_sort").text('排序值不能为空!').css({color:'red'});
                check_error=true;
            }else if($(this).val()>254 || $(this).val()<0 || isNaN($(this).val())){
                $(".i_sort").text('排序值必须为0~254之间的数字!').css({color:'red'});
                check_error=true;
            }else{
                $(".i_sort").html('正确').css({color:''});
            }
        });
        return check_error;
    }

    function add(){
        var cat_name=$('#cat_name').val();
        var parent_id=$('#cat_pid').val();
        var sort=$('#cat_sort').val();
        var is_show=$('#is_show').val();
        if(!cat_name || cat_name.length>20){
            if(!cat_name){
                $(".i_name").text('分类名称不能为空!').css({color:'red'});
            }else if(cat_name.length>20){
                $(".i_name").text('分类名称长度应在0~20之间!').css({color:'red'});
            }
        }else{
                $(".i_name").html('正确').css({color:''});
        }
        if(!sort){
            $(".i_sort").text('排序值不能为空!').css({color:'red'});
        }else if(sort>254 || sort<0 || isNaN(sort)){
            $(".i_sort").text('排序值必须为0~254之间的数字!').css({color:'red'});
        }else{
            $(".i_sort").html('正确').css({color:''});
        }
    }
</script>
</body>

</html>