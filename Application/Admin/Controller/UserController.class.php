<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/3
 * Time: 下午2:01
 */
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller{
    /**
     * 显示用户列表
     */
    public function user_list(){
        $list=M('user')->select();  //获取用户列表所有数据
        $info=M('auth')->select();
        $this->assign('info',$info);
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 添加用户
     */
    public function user_add(){
        $model=M('user');
        if(IS_POST){
            $data=$model->create();     //获取提交的数据
            $data['password']=md5($data['password']);   //将密码加密
            if($model->add($data))
                $this->success('添加成功',U('User/listUser'),1);
            else
                $this->error('添加失败',U('User/addUser'),1);
            exit;
        }
        //显示添加页面
        $info=M('auth')->field('id,title')->select();     //获取到权限分类
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * 删除用户
     */
    public function user_del($id){
        $id=(int)$id;       //将id使用int转义
        if(M('user')->delete($id))
            $this->success('删除成功',U('User/listUser'),1);
        else
            $this->error('删除失败',U('User/listUser'),1);
        exit;
    }

    /**
     * 更改用户信息
     */
    public function user_edit($id){
        $id=(int)$id;
        $model=M('user');
        if(IS_POST){
            $data=$model->create();     //获取所有提交的数据
            $data['id']=$id;        //在数组中加上id
            $data['password']=md5($data['password']);     //将密码加密
            if($model->save($data))
                $this->success('修改成功',U('User/listUser'),1);
            else
                $this->error('修改失败',U('User/editUser?id='.$data['id'].''),1);
            exit;
        }
        //显示修改页面
        $info=$model->where(array('id'=>$id))->find();      //查询获取到id那条记录
        $list=M('auth')->field('id,title')->select();     //查询权限分类
        $this->assign('list',$list);
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * 更改密码
     */
    public function user_edit_pwd(){
        $model=M('User');
        if(IS_POST){
            $data=$model->create();     //获取到提交的数据
            $data['password']=md5($data['password']);   //将密码加密
            $data['id']=I('uid');   //获取到提交的ID值
            $pwd=$model->where(array('id'=>$data['id']))->field('password')->find();   //通过id查找那条记录的密码
            $msg='修改失败';
            if($data['password']==$pwd['password']){    //判断新密码是否和旧密码一样
                $msg='新密码和旧密码一样，修改失败';
            }else{
                if($model->save($data))
                    $msg='修改成功';
            }
            //$this->redirect('/Admin/Admin/index',array(),1,$msg);
            //为了防止跳转的时候在main视图中嵌套，使用js跳转到后台首页
            echo <<<jump
            <script type="text/javascript">
                alert('$msg');
                window.top.location.href='/tpcms/index.php/Admin/Admin/index';
            </script>
jump;
            exit;
        }
        //显示修改页面
        $user=session('username');      //获取登录时保存在会话中的用户名
        $list=$model->field('id,username,realname')->where(array('username'=>$user))->find();   //通过用户名查找记录
        $this->assign('list',$list);
        $this->display();
    }

}