<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/23
 * Time: 下午3:13
 */
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
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
        $this->display();
    }

    /**
     * 后台尾部页面
     */
    public function footer(){
        $this->display();
    }
}