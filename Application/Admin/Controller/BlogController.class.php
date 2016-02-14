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
        //取出文章的分类
        $catemodel=D('Category');
        $catedata=$catemodel->getTree();
        $this->assign('catedata',$catedata);

        $blogmodel=D('Blog');
        $blogdata=$blogmodel->order('bg_id desc')->select();

        //将cat_name加入到blogdata里面
        foreach ($blogdata as $k=>$v) {
            $cat_name=$catemodel->where(array('cat_id'=>$v['cat_id']))->find();
            $blogdata[$k]['cat_name']=$cat_name['cat_name'];

        }
        $this->assign('blogdata',$blogdata);
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
    public function bg_edit(){
        $id=I("get.bg_id");
        //p($id);exit;
        $blogmdoel=D('blog');
        $blogdata=$blogmdoel->select();
        if(IS_POST){
            if($blogmdoel->create()){}
        }


        //取出要修改的字段信息
        $bloginfo=$blogmdoel->find($id);
        //p($bloginfo);exit;
        $this->assign('bloginfo',$bloginfo);
        //取出分类
        $catemodel=D('Category');
        $catedata=$catemodel->getTree();
        $this->assign('catedata',$catedata);
        $this->display();
    }
}