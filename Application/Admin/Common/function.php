<?php
/**
 * Created by PhpStorm.
 * User: lp
 * Date: 2015/11/22
 * Time: 13:35
 */

/*
 * 文件上传
 * @param $imageName 上传文件域的名称
 * @param $config 上传文件的配置信息
 * @param $thumb 生成缩略图的个数以及大小
 */
function uploadImage($imageName,$config,$thumb=array()){
    //取出php.ini中允许单个上传上传的大小限制
    $upload_max_filesize=(int)ini_get('$upload_max_filesize');
    //定义配置信息中上传大小为
    $config['maxSize']=min($upload_max_filesize,$config['maxSize']);
    $upload=new \Think\Upload($config);    //实例化上传类
    //判断是单文件上传还是多文件上传
    if($config['is_array']==1){
        $info=$upload->upload(array($imageName=>$_FILES[$imageName]));
        if($info){
            $img=array();   //定义一个数组，用于存储返回的数据路径
            foreach($info as $k=>$v){
                $singleimg=array();     //定义数组，用来存放每张图片的源图和缩略图地址
                $singleimg[0]=$v['savepath'].$v['savename'];    //保存源图的路径
                //判断是否生成缩略图
                if($thumb){
                    $image=new Think\Image();   //实例化图像处理类
                    foreach($thumb as $k1=>$v1){
                        //打开源图
                        $image->open($config['rootPath'].$singleimg[0]);
                        //定义生成缩略图的路径
                        $thumb_path=$v['savepath'].'thumb_'.$k1.$v['savename'];
                        //生成缩略图并保存
                        $image->thumb($v[0],$v[1])->save($config['rootPath'].$thumb_path);
                        $singleimg[]=$thumb_path;     //将生成的缩略图地址放到数组中
                    }
                }
                $img[]=$singleimg;
            }
            return array(
                'ok'=>1,
                'img'=>$img
            );
        }else{
            return array(
                'ok'=>0,
                'error'=>$upload->getError()
            );
        }
    }else{
        $info=$upload->upload();
        if($info){
            //上传成功后源图的路径
            $img[0]=$info[$imageName]['savepath'].$info[$imageName]['savename'];
            //判断是否要生成缩略图
            if($thumb){
                $image=new Think\Image();   //实例化图像处理类
                foreach($thumb as $k=>$v){
                    //打开源图
                    $image->open($config['rootPath'].$img[0]);
                    //定义生成缩略图的路径
                    $thumb_path=$info[$imageName]['savepath'].'thumb_'.$k.$info[$imageName]['savename'];
                    //生成缩略图并保存
                    $image->thumb($v[0],$v[1])->save($config['rootPath'].$thumb_path);
                    $img[]=$thumb_path;     //将生成的缩略图地址放到数组中
                }
            }
            return array(
                'ok'=>1,
                'img'=>$img
            );
        }else{
            return array(
                'ok'=>0,
                'error'=>$upload->getError()
            );
        }
    }
}
/*
 * 删除上传的图片
 * @param $imgs 数组，图片所在的地址
 * unlink 用来删除文件的函数
 * @符  防止报错
 */
function deleteImage($imgs){
    $root_path=C('rootPath');
    foreach($imgs as $v){
        @unlink($root_path.$v);
    }
}

/*
 *获取分页
 * @param $db 实例化的类名
 * @param $page_id 当前页码
 * @param $where 数组,获取数据的条件参数
 */
function getpage($db,$page_id=1,$where=1){
    $model=D("$db");

    $page_size=C('PAGE_SIZE');
    $count=$model->count();
    $page_count=ceil($count/$page_size);

    if($page_id<=0)
        $page_id=1;
    if($page_id>$page_count)
        $page_id=$page_count;
    $list=$model->where($where)->page($page_id.','.$page_size)->select();

    $page=array('count'=>$count,'page_size'=>$page_size,'page_count'=>$page_count,'page_id'=>$page_id);
    return array('list'=>$list,'page'=>$page);
}

/*
 * 通过数组获取分页
 * @param $data array 纪录的数组
 * @param $page_id int 当前页码
 */
function data_page($data,$page_id=1){

    $page_size=C('PAGE_SIZE');
    $count=count($data);
    $page_count=ceil($count/$page_size);
    if(empty($page_count)){
        $page_count=1;
    }

    if($page_id<=0)
        $page_id=1;
    if($page_id>$page_count)
        $page_id=$page_count;

    $page_header=($page_id-1)*$page_size;
    $page_last=$page_header+$page_size;
    $list=array();

    foreach($data as $k=>$v){
        if($k+1>$page_header && $k+1<=$page_last){
            $list[$k]=$v;
        }
    }
    $page=array('count'=>$count,'page_size'=>$page_size,'page_count'=>$page_count,'page_id'=>$page_id);
    return array('list'=>$list,'page'=>$page);
}