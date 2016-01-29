<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/1/27
 * Time: 下午4:16
 */
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{
    public function login(){
        echo __CONTROLLER__;exit;
        //$this->success('登录成功',U('Admin/index'),2);
        //exit;
        $this->display();
    }

    public function doLogin(){
        $model=D('Admin');
        $error=$model->login();
        var_dump(11111);exit;
    }
}