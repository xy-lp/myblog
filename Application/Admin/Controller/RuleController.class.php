<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/25
 * Time: 下午4:28
 */
namespace Admin\Controller;
use Think\Controller;
class RuleController extends Controller{
    /**
     * 权限列表
     */
    public function rule_list($page_id=1){
        $list=D('rule')->getTree();
        $data=data_page($list,$page_id);
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();

    }

    /**
     * 添加权限
     */
    public function rule_add(){
        $model=M('rule');
        if(IS_POST){
            $data=$model->create();
            $i=$model->where(array('ru_name'=>$data['ru_name']))->find();
            if($i){
                $this->error('该权限已存在',U('Rule/rule_add'),1);
                exit;
            }
            if($model->add($data))
                $this->success('添加成功',U('Rule/rule_list'),1);
            else
                $this->error('添加失败',U('Rule/rule_add'),1);
            exit;
        }
        $list=$model->order('ru_order')->where(array('ru_pid'=>'0','ru_status'=>'1'))->select();
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 删除权限
     */
    public function rule_del($id){
        $id=(int)$id;
        $catemodel=D('Rule');
        $info=$catemodel->where("ru_pid=$id")->select();
        if($info){
            $this->error('不能删除有子类的权限');
        }
        if($catemodel->delete($id)){
            $this->success('删除成功',U('rule_list'));exit;
        }else{
            $this->error('删除失败');exit;
        }
    }

    /**
     * 修改权限
     */
    public function rule_edit($id){
        $model=D('Rule');
        if(IS_POST){
            if($data=$model->create()){
                //判断提交的父id是否是自己和自己的子分类
                $id=I('post.id');
                $data['ru_id']=$id;
                if($model->save($data)!==false){
                    $this->success('修改成功',U('rule_list'));
                    exit;
                }else{
                    $this->error($model->getError());
                }
            }else{
                $this->error($model->getError());
            }
        }
        $id=(int)$id;
        //取出要修改的分类的数据
        $info=$model->find($id);
        $this->assign('id',$id);
        $this->assign('info',$info);
        $data=$model->order('ru_order')->where(array('ru_pid'=>'0','ru_status'=>'1'))->select();
        $this->assign('data',$data);
        $this->display();
    }
}