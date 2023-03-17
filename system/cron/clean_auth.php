<?php
include("../core/core.php");

$key = daddslashes($_GET['key']);

if($key!=$conf['system_cron_key']){
    exit('{"code":-1,"msg":"密钥不正确","date":"'.$date.'"}');
}elseif($conf['system_cron_ip_active']=='1' && !in_array($clientip,explode(",",$conf['system_cron_ip']))){
    exit('{"code":-1,"msg":"监控端IP：'.$clientip.' 不在白名单","date":"'.$date.'"}');
}elseif($key==$system['token']){
    
}else{
    exit('{"code":-1,"msg":"未知错误","date":"'.$date.'"}');
}
?>