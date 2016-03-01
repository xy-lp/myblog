<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/2/23
 * Time: 下午4:02
 */
namespace Admin\Model;
use Think\Model;
class BlogModel extends Model{
    /**
     * 字段验证
     */
    protected $insertFields=array('bg_title','bg_author','bg_excerpt','bg_content','bg_time','cat_id','bg_imgpath');
    protected $updateFields=array('bg_title','bg_author','bg_excerpt','bg_content','bg_time','cat_id','bg_imgpath');

    /**
     * 自动验证
     */
    protected $_validate=array(
        array('bg_title','require','文章标题不能为空'),
        array('bg_title','0,50','文章标题应为50字以内!',0,'length',3),
        array('bg_title','','文章标题已存在!',1,'unique','self::MODEL_INSERT'),
        array('bg_author','require','作者不能为空'),
        array('bg_author','0,32','作者名应为32字以内!',0,'length',3),
        array('bg_excerpt','require','文章描述不能为空'),
        array('bg_author','0,32','文章描述应为100字以内!',0,'length',3),
        array('bg_content','require','文章内容不能为空'),
    );

    /**
     * 上传图片
     */
    protected function _before_insert(&$data,$options){
        //定义上传文件的配置信息
        $config = array(
            'mimes'         =>  array('image/jpg','image/png','image/jpeg','image/gif'), //允许上传的文件MiMe类型
            'rootPath'      =>  C('rootPath'),  //上传的文件根节点
            'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
            'savePath'      =>  'Blog/', //保存路径
            'is_array'      =>  0   //声明单文件上传
        );
        //执行上传文件和生成缩略图的操作
        $res  = uploadImage('goods_img',$config);
        //判断上述操作是否执行成功
        if($res['ok']==1){
            //将源图和缩略图的地址存放$data数组中写入数据库
            $data['imgpath']=$res['img'][0];
        }else{
            //返回上传文件和生成缩略图中产生的错误
            $this->error=$res['error'];
            return false;
        }
    }
}