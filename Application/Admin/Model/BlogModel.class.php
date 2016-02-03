<?php
namespace Admin\Model;
use Think\Model;
class BlogModel extends Model{

    /**
     * 字段验证
     */
    protected $insertFields=array('bg_title','bg_author','bg_content');
    protected $updateFields=array('bg_title','bg_author','bg_content');

    /**
     * 自动验证
     */
    protected $_validate=array(
        array('bg_title','require','文章标题不能为空'),
        array('bg_author','require','作者不能为空'),
        array('bg_content','require','文章内容不能为空'),
    );
}