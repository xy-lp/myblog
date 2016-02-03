<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/1/29
 * Time: 下午1:46
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class CategoryController extends Controller{
    /**
     * 显示分类列表
     */
    public function cat_list(){
        $list=D('Category')->getTree();
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 添加分类操作
     */
    public function cat_add(){
        $model=D('Category');
        if(IS_POST){
            if(!$data=$model->create()){
                echo 111;exit;
                $this->error($model->getError(),U('Category/cat_add'),1);
            }else{
                if($model->add($data))
                    $this->success('添加成功',U('Category/cat_list'),1);
                else
                    $this->error('添加失败',U('Category/cat_add'),1);
            }
            exit;
        }
        $cat_list=$model->where(array('is_show'=>'1','cat_pid'=>'0'))->select();
        $this->assign('cat_list',$cat_list);
        $this->display();
    }

    /**
     * 删除分类
     */
    public function cat_del(){
        $id=I('get.cat_id');
        $catemodel=D('Category');
        $info=$catemodel->where("cat_pid=$id")->select();
        if($info){
            $this->error('不能删除有子分类的分类');
        }
        if($catemodel->delete($id)){
            $this->success('删除成功',U('cat_list'));exit;
        }else{
            $this->error('删除失败');exit;
        }
    }

    /**
     * 修改分类
     */
    public function cat_update(){
        $id=I('get.cat_id');
        //p($id);exit;
        $catemodel=D('Category');
        if(IS_POST){
            if($data=$catemodel->create()){
                //判断提交的父id是否是自己和自己的子分类
                $id=I('post.id');
                $ids=$catemodel->getChild($id);
                //把自己的id添加到子孙分类中
                $ids[]=$id;
                if(in_array($data['cat_pid'],$ids)){
                    $this->error('不能把自己和自己的子孙分类当作父级分类');
                }
                $data['cat_id']=$id;
                if($catemodel->save($data)!==false){
                    $this->success('修改成功',U('cat_list'));
                    exit;
                }else{
                    $this->error($catemodel->getError());
                }
            }else{
                $this->error($catemodel->getError());
            }
        }
        //取出要修改的分类的数据
        $cateinfo=$catemodel->find($id);
        $ids=$catemodel->getChild($id);
        $ids[]=$id;
        $this->assign('id',$id);
        $this->assign('cateinfo',$cateinfo);
        $catedata=$catemodel->getTree();
        $this->assign('catedata',$catedata);
        $this->display();
    }
}
