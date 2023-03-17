<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax.php
* @Action  : 文章系统Ajax
*/

include("../../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    // 文章列表
    case 'list':
        $arr =array();
        $pagesize = 6;
        $pages = intval($numrows/$pagesize);
        if ($numrows%$pagesize){
            $pages++;
        }
        if (isset($_GET['page'])){
            $page = intval($_GET['page']);
        }else{
            $page = 1;
        }
        $offset = $pagesize * ($page - 1);
        $row = $DB->query("SELECT id,time,title,titles,img,number,author,uid FROM website_article WHERE active = '1' order by uid desc limit $offset,$pagesize");
        $count_all = $DB->count("SELECT count(*) from website_article where active = '1'");
        while($res = $DB->fetch($row)){
            array_unshift($arr,$res);
            $count_page++;
        }
        $result = array(
            "code"=>1,
            "msg"=>"文章列表获取成功",
            "count_all"=>$count_all,
            "count_page"=>$count_page,
            "data"=>$arr
        );
    break;
    
    default:
        $result = array(
            "code"=>-4,
            "msg"=>"No Act"
        );
    break;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);