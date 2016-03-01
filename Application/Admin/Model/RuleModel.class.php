<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/25
 * Time: 下午4:38
 */
namespace Admin\Model;
use Think\Model;
class RuleModel extends Model{
    /**
     * 通过递归获取二维数组
     * @param $list array 需要生成书结构的数组
     * @param $parent_id int 父类id
     * @param $deep int 当前深度
     * @return array 排序好的数组
     */
    private function createTree($list,$ru_pid,$deep=0){
        static $tree=array();   //静态变量,防止递归的时候被覆盖
        foreach ($list as $rows){
            if($ru_pid==$rows['ru_pid']){
                $rows['deep']=$deep;
                $tree[]=$rows;
                $this->createTree($list,$rows['ru_id'],$deep+1);
            }
        }
        return $tree;
    }

    /**
     * 获取栏目的树形结构
     * @param $parent_id int 父类id(默认为0)
     * @return array 获取生成好的数组
     */
    public function getTree($ru_pid=0){
        $list= $this->select();
        //p($list);
        return $this->createTree($list, $ru_pid,$deep=0);
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
    private function _getChild($arr,$id){
        static $ids=array();
        foreach($arr as $v){
            if($v['ru_pid']==$id){
                $ids[]=$v;
                $this->_getChild($arr,$v['ru_id']);
            }
        }
        return $ids;
    }
}