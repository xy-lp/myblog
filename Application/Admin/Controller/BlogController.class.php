<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/23
 * Time: 下午4:01
 */
namespace Admin\Controller;
use Think\Controller;
class BlogController extends BaseController{
    /**
     * 博客列表
     */
    public function bg_list($page_id=1){
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

        $data=data_page($blogdata,$page_id);
        //p($data);
        $this->assign('blogdata',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();
    }

    /**
     * 发表博客
     */
    public function bg_add(){
        if(IS_POST){
            $blogmodel=D('Blog');
            if($data=$blogmodel->create()){
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
        //写入模版
        $this->assign('catedata',$catedata);
        $this->display();
    }

    /**
     * 删除博客
     * @bg_id int 纪录的id
     */
    public function bg_del($bg_id){
        $bg_id=(int)$bg_id;
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
        $blogmdoel=D('blog');
        if(IS_POST){
            //获取表单提交的数据
            if($data=$blogmdoel->create()){
                $data['bg_id']=I('post.bg_id');     //获取修改数据的原id
                $data['bg_update_time']=time();     //'博客修改时间'字段
                if($blogmdoel->save($data)){
                    $this->success('修改成功',U('bg_list'),1);
                    exit;
                }else{
                    $this->error($blogmdoel->getError());
                }
            }
        }
        $id=I("get.bg_id");
        //取出要修改的字段信息
        $bloginfo=$blogmdoel->find($id);
        //p($bloginfo);exit;
        $this->assign('bloginfo',$bloginfo);
        //取出分类
        $catemodel=D('Category');
        $catedata=$catemodel->getTree();
        //p($catedata);
        $this->assign('catedata',$catedata);
        $this->display();
    }
}