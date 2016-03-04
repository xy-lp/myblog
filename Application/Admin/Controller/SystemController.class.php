<?php
/**
 * Created by PhpStorm.
 * User: just
 * Date: 16/3/1
 * Time: 上午9:57
 */
namespace Admin\Controller;
use Think\Controller;
class SystemController extends BaseController{
    /**
     * 导出数据
     */
    public function export_data(){
        $host = C('DB_HOST') . (C('DB_PORT') ? ":" . C('DB_PORT') : '');
        $user = C('DB_USER');
        $password = C('DB_PWD');
        $dbname = C('DB_NAME');
        $prefix = C('DB_PREFIX');
        //连接mysql数据库
        if (!mysql_connect($host, $user, $password)) {
            $this->error('数据库连接失败');
        }
        //是否存在该数据库
        if (!mysql_select_db($dbname)) {
            $this->error('不存在数据库:' . $dbname);
        }
        set_time_limit(0);
        mysql_query("SET interactive_timeout=3600, wait_timeout=3600 ;");
        mysql_query("set names 'utf8'");
        $mysql = "set charset utf8;\r\n";
        $q1 = mysql_query("show tables like '$prefix%'");
        while ($t = mysql_fetch_array($q1)) {
            $table = $t [0];
            $q2 = mysql_query("show create table `$table`");
            $sql = mysql_fetch_array($q2);
            $mysql .= $sql ['Create Table'] . ";\r\n";
            $q3 = mysql_query("select * from `$table`");
            while ($data = mysql_fetch_assoc($q3)) {
                $keys = array_keys($data);
                $keys = array_map('addslashes', $keys);
                $keys = join('`,`', $keys);
                $keys = "`" . $keys . "`";
                $vals = array_values($data);
                $vals = array_map('mysql_real_escape_string', $vals);
                $vals = join("','", $vals);
                $vals = "'" . $vals . "'";
                $vals = str_replace("''", "null", $vals);
                $mysql .= "insert into `$table`($keys) values($vals);\r\n";
            }
        }
        $filename = $dbname . ' ' . date('Y/m/d', time()) . '.sql';
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . $filename);
        echo $mysql;
    }
}