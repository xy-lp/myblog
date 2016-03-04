<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/23
 * Time: 下午3:13
 */
namespace Admin\Controller;
use Think\Controller;
class AdminController extends BaseController{
    /**
     * 框架结构
     */
    public function index(){
        $this->display();
    }

    /**
     * 后台头部页面
     */
    public function top(){
        $realname=M('user')->field('us_realname')->where(array('us_username'=>session('username')))->find();
        $this->assign('realname',$realname['us_realname']);
        $this->display();
    }

    /**
     * 后台左导航栏页面
     */
    public function left(){
        $this->display();
    }

    /**
     * 后台显示部分页面
     */
    public function main(){
        $login_time=M('user')->field('us_login_time')->where(array('us_username'=>session('username')))->find();
        $this->assign('login_time',$login_time['us_login_time']);
        $this->display();
    }

    /**
     * 后台尾部页面
     */
    public function footer(){
        $this->display();
    }
}