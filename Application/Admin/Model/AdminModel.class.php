<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/1/27
 * Time: 下午5:11
 */
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
    public function login(){
        $username=I('post.username');
        return $username;
    }
}