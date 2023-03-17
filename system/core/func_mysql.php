<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : func_mysql.php
* @Action  : 数据库操作
*/

function mysql_count($mysql)
{
    global $DB;
    $result = $DB->count("SELECT count(*) from ".$mysql."");
    if($result){
        return $result;
    }else{
        return '数据表不存在';
    }
}
?>