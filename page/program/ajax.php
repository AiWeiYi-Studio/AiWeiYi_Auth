<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax.php
* @Action  : 程序列表Ajax
*/

include("../../system/core/core.php");
@header('Content-Type: application/json; charset=UTF-8');

$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

switch($act){

case 'list':
exit('{
    "code": "1",
    "msg": "成功",
    "count": "8",
    "data": [
    {
            "id": "3",
            "top": ">",
            "title": "陌屿加密系统V10.2.2",
            "img": "\/Sharl\/upload\/fdfb13b2ce0bbe5b412212149759c5eb.png",
            "email": "2763994904",
            "date": "2020-09-14 19:55:18",
            "QQName": "print",
            "title_site": "带五种加密算法，PHP代码加密系统！",
            "active": "正常"
        },
    ]
}');
break;
   
default:
    exit('{"code":-1,"msg":"Not Act"}');
break;
}