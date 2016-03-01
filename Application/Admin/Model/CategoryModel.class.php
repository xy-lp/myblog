<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/23
 * Time: 下午3:25
 */
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model{
    /**
     * 字段映射
     */
    protected $_map=array(
        'name'=>'cat_name',
        'pid'=>'cat_pid',
        'sort'=>'cat_sort',
        'show'=>'is_show',
    );


    /**
     * 验证表单合法性
     * @attr $insertFields array 定义添加的字段名
     * @attr $updateFields array 定义修改的字段名
     * 注意:字段名与数据库中字段名一致
     */
    protected $insertFields=array('cat_name','cat_pid','cat_sort','is_show');
    protected $updateFields=array('cat_name','cat_pid','cat_sort','is_show');

    /**
     * 自动验证
     */
    protected $_validate=array(
        array('cat_name','require','分类名称不能为空!'),
        array('cat_name','0,20','分类名称应为20字以内!',0,'length',3),
        array('cat_name','','分类名称已存在!',1,'unique','self::MODEL_INSERT'),
        //array('cat_pid','number','父类id错误!'),
        array('cat_sort','0,254','排序值应为0~254之间的数字',0,'between',3),
        array('cat_sort','number','排序值应为0~254之间的数字!'),
        array('is_show','array(0,1)',0,'请选择是否显示',3,'in'),
    );

    /**
     * 通过递归获取二维数组
     * @param $list array 需要生成书结构的数组
     * @param $parent_id int 父类id
     * @param $deep int 当前深度
     * @return array 排序好的数组
     */
    private function createTree($list,$parent_id,$deep=0){
        static $tree=array();   //静态变量,防止递归的时候被覆盖
        foreach ($list as $rows){
            if($parent_id==$rows['cat_pid']){
                $rows['deep']=$deep;
                $tree[]=$rows;
                $this->createTree($list,$rows['cat_id'],$deep+1);
            }
        }
        return $tree;
    }

    /**
     * 获取栏目的树形结构
     * @param $parent_id int 父类id(默认为0)
     * @return array 获取生成好的数组
     */
    public function getTree($parent_id=0){
        $list= $this->where(array('is_show'=>'1'))->select();
        return $this->createTree($list, $parent_id,$deep=0);
    }

    /**
     * 获取自己的子分类
     * @param $id int 当前纪录的id
     * @return array 子类id的数组
     */
    public function getChild($id){
        $arr=$this->select();
        return $this->_getChild($arr,$id);
    }

    /**
     * 生成子分类的数组
     * @param $arr array 数据的总集
     * @param $id int 当前纪录的id
     * @return array 子类id的集合
     */
    public function _getChild($arr,$id){
        static $ids=array();
        foreach($arr as $v){
            if($v['cat_pid']==$id){
                $ids[]=$v;
                $this->_getChild($arr,$v['cat_id']);
            }
        }
        return $ids;
    }

}