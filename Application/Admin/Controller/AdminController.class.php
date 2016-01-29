<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/1/27
 * Time: 下午4:32
 */
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
    public function index(){
        $this->display();
    }
    public function top(){
        $this->display();
    }
    public function left(){
        $this->display();
    }
    public function main(){
        $this->display();
    }
    public function footer(){
        $this->display();
    }
}