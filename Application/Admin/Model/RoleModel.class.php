<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/26
 * Time: 下午2:02
 */
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model{
    /**
     * 验证表单合法性
     * @attr $insertFields array 定义添加的字段名
     * @attr $updateFields array 定义修改的字段名
     * 注意:字段名与数据库中字段名一致
     */
    protected $insertFields=array('re_name','re_status');
    protected $updateFields=array('re_name','re_status','re_id');


    /**
     * 钩子函数
     * 删除操作之后
     * @$data array 要删除的纪录信息
     * @$options null
     * @return bool true or false
     */
    public function _before_delete(&$data,$options){
        $re_id=$data['where']['re_id'];
        M('role_rule')->where(array('re_id'=>$re_id))->delete();
    }

    /**
     * 钩子函数
     * 更新之前的操作
     * @$data array 修改的数据
     * @$options array 修改的那条纪录信息
     * @return bool true or false
     */
    public function _before_update(&$data,$options){
        $re_id=$options['where']['re_id'];
        //获取新的权限
        $rdata=explode(',',$data['re_rules']);
        $rmodel=M('role_rule');

        //角色写入新的权限之前先删除所有它自己的权限
        $rmodel->where(array('re_id'=>$re_id))->delete();
        foreach($rdata as $k=>$v){
            //判断属性值是不是二维数组
            if(is_array($v)){
                //如果是二维数组，再循环
                foreach($v as $v1){
                    //将每个属性值分别写入数据库
                    $rmodel->add(array(
                        're_id'=>$re_id,
                        'ru_id'=>$v1,
                    ));
                }
            }else{
                //如果不是二维数组，直接将属性值写入数据库
                $rmodel->add(array(
                    're_id'=>$re_id,
                    'ru_id'=>$v,
                ));
            }
        }
    }

    /**
     * 列表页显示权限名称
     * @$bool bool default 'false' return值是否截取
     * @return array 返回的数据
     */
    public function get_list($bool=false){
        //获取所有角色的信息
        $list=$this->select();
        $model=M('rule');
        if(!empty($list)){
            //通过循环获取每个角色相应的权限
            foreach($list as $k=>$v){
                $i=explode(',',$v['re_rules']);
                if(!empty($i)){
                    $str=array();
                    //通过角色的权限id获取相应的权限名
                    foreach($i as $v1){
                        $array=$model->field('ru_name')->where(array('ru_id'=>$v1))->find();
                        $str[]=$array['ru_name'];
                    }
                    //判断是否截取前39个字符
                    if($bool){
                        $list[$k]['ru_names']=mb_substr(implode(',',$str),0,39,'UTF-8').'....';
                    }else{
                        $list[$k]['ru_names']=implode(',',$str);
                    }
                }
            }
        }
        return $list;
    }

}