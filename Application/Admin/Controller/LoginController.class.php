<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/3/3
 * Time: 上午12:37
 */
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
    //显示登录页面
    public function login(){
        $name=$_COOKIE['identifier'];
        if(!empty($name)){
            $model=M('user');
            $token=$_COOKIE['token'];
            $info=$model->where(array('us_identifier'=>$name,'us_token'=>$token))->field('us_username,us_token,us_time_out,us_role_id')->find();
            if($info && $info['us_time_out']>time()){
                $data['us_login_time']=time();     //获取当前的时间戳
                $data['us_login_ip']=$_SERVER['SERVER_ADDR'];   //获取当前的ip地址
                $model->where(array('us_username'=>$info['us_username']))->save($data);   //将数据库中登录时候和ip地址更新
                //获取账号权限，并写入session
                $rule=M('role')->field('re_rules')->where(array('re_id'=>$info['us_role_id']))->find();    //获取账号相应的权限
                session('rules',$rule['re_rules']);      //将账号的权限保存到session中
                session('username',$info['us_username']);  //将账号保存到session中
                $this->redirect('Admin/index');
                exit;
            }
        }
        $this->display();
    }
    //执行登录操作
    public function checkLogin(){
        if(Is_POST){
            /*$verify=new Verify();
            //验证验证码是否正确
            if(!$verify->check(I('post.code'))){
                $this->error('验证码错误！',U('Login/login'),1);
            }*/

            $model=M('user');      //实例化user表
            $data['us_username']=I('post.username');
            $i=$model->where($data)->find();    //获取user表中相应的记录
            if(!$i){
                $this->error('该账号不存在！',U('Login/login'),1);
            }
            $pwd=md5(I('post.password').$i['us_salt']);     //获取提交的密码
            if(!$i || $i['us_password']!=$pwd){
                $this->error('密码错误，请重新输入！',U('Login/login'),1);
            }
            if($i['us_role_id']==0){      //判断账号是否拥有权限
                $this->error('您的账号没有权限！',U('Login/login'),1);
            }
            $save_pwd=isset($_POST['remember'])?$_POST['remember']:0;
            if($save_pwd!=0){
                $data['us_identifier'] = md5($i['username']);
                $data['us_token'] = md5(uniqid(rand(), TRUE));
                cookie('identifier',$data['us_identifier'],3600*24*7);
                cookie('token',$data['us_token'],3600*24*7);
                $data['us_time_out']=time()+(3600*24*7);    //获取当前的时间戳
            }
            //更改数据库中该账号的登录时间和ip地址
            $data['us_login_time']=time();     //获取当前的时间戳
            $ip=$_SERVER['SERVER_ADDR'];   //获取当前的ip地址
            $data['us_login_ip']=bindec(decbin(ip2long($ip)));  //将IP地址变成int型
            $model->where(array('us_username'=>$data['us_username']))->save($data);   //将数据库中登录时候和ip地址更新
            //获取账号权限，并写入session
            $rule=M('role')->field('re_rules')->where(array('re_id'=>$i['us_role_id']))->find();    //获取账号相应的权限
            session('rules',$rule['re_rules']);      //将账号的权限保存到session中
            session('username',$data['us_username']);  //将账号保存到session中
            $this->success('登录成功',U('Admin/index'),1);
        }
    }
    //退出操作
    public function outLogin(){
        $info=M('user')->field('us_id,us_time_out')->where(array('us_username'=>session('username')))->find();
        if(!empty($info['us_time_out'])){
            $data['us_time_out']=time();    //获取当前的时间戳
            $data['us_id']=$info['us_id'];
            M('user')->where(array('us_username'=>session('username')))->save($data);  //将cookie过期时间设为当前时间
        }
        //清除会话
        session('username',null);
        session_unset();
        session_destroy();
        $this->redirect('Login/login');
    }
}