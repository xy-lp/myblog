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
        $blogmodel=D('Blog');
        $blogdata=$blogmodel->select();
        $this->assign('blogdata',$blogdata);

        //取出文章的分类
        $catemodel=D('Category');
        $catedata=$catemodel->getTree();
        $this->assign('catedata',$catedata);
        $this->display();
    }

    /**
     * 发表博客
     */
    public function bg_add(){
        if(IS_POST){
            $blogmodel=D('Blog');
            if($blogmodel->create()){
                if($blogmodel->add()){
                    $this->success('添加成功',U('bg_list'));
                    exit;
                }
            }
            $error=$blogmodel->getError();
            if(empty($error)){
                $error='添加失败';
            }
            $this->error($error);
        }
        //取出文章的分类
        $catemodel=D('Category');
        $catedata=$catemodel->getTree();
        $this->assign('catedata',$catedata);
        $this->display();
    }

    /**
     * 删除博客
     */
    public function bg_del($bg_id){
        $bg_id=I('get.bg_id');
        //echo $bg_id;exit;
        $blogmodel=D('Blog');
        if($blogmodel->delete($bg_id)){
            $this->success('删除成功',U('bg_list'),1);
        }
        else{
            $this->error('删除失败');
        }
    }

    /**
     * 博客修改
     */
    public function bg_update(){
        $this->display();
    }
}