<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/25
 * Time: 下午4:04
 */
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller{
    /**
     * 显示用户列表
     */
    public function user_list($page_id=1){
        $list=M('user')->select();  //获取用户列表所有数据
        $info=M('role')->field('re_id,re_name')->where(array('re_status'=>'1'))->select();
        $data=data_page($list,$page_id);
        $this->assign('info',$info);
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();
    }

    /**
     * 添加用户
     */
    public function user_add(){
        $model=M('user');
        if(IS_POST){
            if($data=$model->create()){
                //获取提交的数据
                $data['us_password']=md5($data['password']);   //将密码加密
                //生成密码密钥
                $data['us_salt']=md5(uniqid(rand(), TRUE));
                //生成密码
                $data['us_password']= md5($data['password'].$data['salt']);
                if($model->add($data))
                    $this->success('添加成功',U('User/user_list'),1);
                else
                    $this->error('添加失败',U('User/user_add'),1);
                exit;
            }else{
                $this->error($model->getError());
            }
        }
        //显示添加页面
        $info=M('role')->field('re_id,re_name')->where(array('re_status'=>'1'))->select();     //获取到权限分类
        $this->assign('info',$info);
        //p($info);
        $this->display();
    }

    /**
     * 删除用户
     */
    public function user_del($id){
        $id=(int)$id;
        if(M('User')->delete($id))
            $this->success('删除成功',U('user_list'),1);
        else
            $this->error('删除失败',U('user_list'),1);
    }

    /**
     * 修改用户
     */
    public function user_edit($id){
        $id=(int)$id;
        $model=D('User');
        if(IS_POST){
            if($data=$model->create()){
                $data['us_id']=I('post.id');
                if($model->save($data)){
                    $this->success('修改成功',U('user_list'),1);
                    exit;
                }else{
                    $this->error($model->getError());
                }
            }else{
                $this->error($model->getError());
            }
        }
        $list=$model->where(array('us_id'=>$id))->find();
        $this->assign('list',$list);
        $info=M('role')->field('re_id,re_name')->where(array('re_status'=>'1'))->select();
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * 修改密码
     */
    public function edit_pwd(){

    }
}
