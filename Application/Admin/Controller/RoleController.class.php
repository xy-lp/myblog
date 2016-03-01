<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/25
 * Time: 下午4:26
 */
namespace Admin\Controller;
use Think\Controller;
class RoleController extends Controller{
    /**
     * 角色列表
     */
    public function role_list($page_id=1){
        $model=D('Role');
        $list=$model->get_list(true);
        $data=data_page($list,$page_id);

        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();
    }

    /**
     * 添加角色
     */
    public function role_add(){
        if(IS_POST){
            $model=D('Role');
            if($data=$model->create()){
                if($model->add($data)){
                    $this->success('添加成功',U('role_list'),1);
                    exit;
                }else{
                    $this->error($model->getError());
                }
            }else{
                $this->error($model->getError());
            }
        }
        $this->display();
    }

    /**
     * 删除角色
     */
    public function role_del($id){
        $id=(int)$id;
        if(D('Role')->delete($id)){
            $this->success('删除成功',U('role_list'),1);
        }else{
            $this->error('删除失败',U('role_list'),1);
        }
    }

    /**
     * 修改角色
     */
    public function role_edit($id){
        $id=(int)$id;
        $model=D('Role');
        if(IS_POST){
            if($data=$model->create()){
                $data['re_id']=I('post.id');
                if($model->save($data)){
                    $this->success('修改成功',U('role_list'),1);
                    exit;
                }else{
                    $this->error($model->getError());
                }
            }else{
                $this->error($model->getError());
            }
        }
        $info=$model->where(array('re_id'=>$id))->find();
        $this->assign('info',$info);
        //p($info);
        $this->display();
    }

    /**
     * 分配权限
     */
    public function get_rule(){
        $ru_model=M('rule');
        $model=D('role');
        if(IS_POST){
            if($ru_ids=$ru_model->create()){
                $data['re_rules']=implode(',',$ru_ids['ru_id']);
                $data['re_id']=I('post.role_id');
                //p($data);
                if($model->save($data))
                    $this->success('保存成功',U('role_list'),1);
                else {
                    $this->error($model->getError());
                }
                exit;
            }else{
                $this->error($model->getError());
            }
        }
        $id=(int)I('get.id');
        $rules=$model->field('re_rules')->where(array('re_id'=>$id))->find();
        $re_list=explode(',',$rules['re_rules']);
        $list=$ru_model->where(array('ru_pid'=>'0','ru_status'=>'1'))->select();
        $map['ru_pid']=array('NEQ','0');
        $map['ru_status']=array('EQ','1');
        $info=$ru_model->where($map)->select();
        $this->assign('id',$id);
        $this->assign('rule',$re_list);
        $this->assign('list',$list);
        $this->assign('info',$info);
        //p($re_list);
        $this->display();
    }
}