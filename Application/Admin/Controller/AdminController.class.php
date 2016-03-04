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
        $user=session('username');  //获取保存在会话中的用户名
        //通过用户名在user表中查找相应数据中的rule(权限)字段
        $userRole=M('user')->field('us_role_id')->where(array('us_username'=>$user))->find();
        //通过在获取到的rule在权限表中查找相应的权限
        $rules=M('role')->field('re_rules')->where(array('re_id'=>$userRole['us_role_id']))->find();
        $ru_array=explode(',',$rules['re_rules']);

        $model=M('rule');
        $map['ru_id']=array('in',$ru_array);
        $map['ru_status']=array('eq','1');
        $map['ru_pid']=array('eq','0');
        $list=$model->order('ru_id asc')->where($map)->select();

        $map['ru_pid']=array('neq','0');
        $info=$model->order('ru_order asc')->where($map)->select();

        //p($info);
        $this->assign('list',$list);
        $this->assign('info',$info);
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