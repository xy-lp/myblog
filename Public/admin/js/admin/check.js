/**
 * Created by just on 16/2/29.
 */
$(document).ready(function(){
    check_All();
    del_All();
});
function check_All(){
    $('.ckbox').bind('click',function(){
        if($('.ckbox').attr('checked')==true){
            $('.ckbox1').attr('checked',true);
        }else{
            $('.ckbox1').attr('checked',false);
        }
    });
}

function del_All(){
    $('.del_All').bind('click',function(){
        alert(1111);
    });
}


