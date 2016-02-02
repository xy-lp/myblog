<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/1/29
 * Time: 下午1:46
 */
namespace Admin\Controller;
use Think\Controller;
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
        if(IS_POST){
            $model=D('Category');
            if(!$data=$model->create()){
                $this->error($model->getError(),U('Category/cat_add'),1);
            }else{
                if($model->add($data)){
                    $this->success('添加成功',U('Category/cat_list'),1);
                    exit;
                }else{
                    $this->error('添加失败',U('Category/cat_add'),1);
                }
            }
        }
        $this->display();
    }

}
