<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/2
 * Time: 下午3:45
 */
namespace Admin\Controller;
use Think\Controller;
class BlogController extends Controller{
    /**
     * 博客列表
     */
    public function bg_list(){
        $this->display();
    }

    /**
     * 发表博客
     */
    public function bg_add(){
        $this->display();
    }

    /**
     * 删除博客
     */
    public function bg_del(){

    }

    /**
     * 博客修改
     */
    public function bg_edit(){
        $this->display();
    }
}