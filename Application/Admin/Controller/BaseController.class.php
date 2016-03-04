<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/3/4
 * Time: 上午11:05
 */
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller{
    public function __construct(){
        parent::__construct();
        $this->checkLogin();
        //$this->checkAuth();
    }
    private function checkLogin(){
        $name=session('username');
        if(empty($name)){
            echo <<<jump
			<script type="text/javascript">
			alert('您还没登录，请先登录');
		    window.top.location.href='/index.php/admin/login/login';
		    </script>
jump;
            exit;
        }
    }

    private function checkAuth(){
        $allow_controller_array=array('login','admin');
        if(!in_array(strtolower(CONTROLLER_NAME),$allow_controller_array)){
            $rules=session('rules');
            $ru_array=explode(',',$rules);
            //p($ru_array);
            $now_ru='Admin/'.CONTROLLER_NAME.'/'.ACTION_NAME;
            $i=M('rule')->field('ru_id')->where(array('ru_url'=>$now_ru))->find();
            //p($i);
            if($i){
                if(in_array($i['ru_id'],$ru_array)){
                    return true;
                }
            }
            die('你没有该权限');
        }
    }

}
