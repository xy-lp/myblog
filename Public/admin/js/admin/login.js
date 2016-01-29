$(function(){
    $('.btn').bind('click',function(){
        login();
    });
})

/**
 *登录验证
 * done()   ajax返回成功后执行
 * always() 无论ajax是否成功都会执行
 */
function login(){
    var username=$('#username').val();
    var pwd=$('#password').val();
    var btn=$('.btn');
    //简单判断,减少不必要的提交
    if(!username || !pwd || btn.hasClass('disabled')){
        if(!username){
            fade('用户名不能为空!');
        }else if(!pwd){
            fade('密码不能为空!');
        }
        return false;
    }
    //添加按钮的不可点击的状态
    btn.val('登录中...').addClass('disabled');
    //通过ajax提交表单到服务器判断
    var login=$.post('/admin/login/doLogin',$('#login_from').serialize(),null,'json');
    login.done(
        function(data){
            //判断是否登录成功,成功跳转,不成功则显示错误
            if(!data['error']){
                var redirect=data['target'];
                window.location.replace(redirect);
            }else{
                fade(data['msg']);
            }
        }
    ).always(
        function (){
            //解除按钮的状态
            btn.val('登录').removeClass('disabled');
        }
    );
}

/**
 *错误显示的效果
 * fadeIn   淡入
 * fadeOut  淡出
 */
function fade($msg){
    //$('.prompt').html($msg).fadeIn().fadeOut(3000);
    $('.prompt').html($msg).fadeIn();
}