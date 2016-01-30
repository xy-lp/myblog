<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        echo 'index方法';exit;
        $this->display();
    }
    public function text(){
        echo 'text方法';
    }
}