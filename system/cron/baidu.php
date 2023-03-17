<?php
include("../core/core.php");
if($conf['rewrite_program']=='1'){
    $program_url = $siteurls.'program/index.html';
}else{
    $program_url = $siteurls.'page/program/index.php';
}
if($conf['rewrite_article']=='1'){
    $article_url = $siteurls.'article/index.html';
}else{
    $article_url = $siteurls.'page/article/index.php';
}
$demo_url = $siteurls.'demo/index.html';

$key = daddslashes($_GET['key']);
if($key!=$conf['system_cron_key']){
    exit('{"code":-1,"msg":"密钥不正确","date":"'.$date.'"}');
}elseif($conf['system_cron_ip_active']=='1' && !in_array($clientip,explode(",",$conf['system_cron_ip']))){
    exit('{"code":-1,"msg":"监控端IP：'.$clientip.' 不在白名单","date":"'.$date.'"}');
}elseif($key==$system['token']){

    $baidu_post = array(
        ''.$siteurls.'index.php',
        ''.$demo_url.'',
        ''.$program_url.'',
        ''.$article_url.''
    );
    $api = 'http://data.zz.baidu.com/urls?site='.$siteurls.'&token='.$conf['site_baidu'];
    $ch = curl_init();
    $options =  array(
        CURLOPT_URL => $api,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => implode("\n", $baidu_post),
        CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
    );
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    $arr = json_decode($result,true);
    file_put_contents("../../file/log/cron/baidu/".$date.".log",$result);
    $path = 'file/log/cron/baidu/'.$date.'.log';
    $fail = count($arr['not_valid'])+count($arr['not_same_site']);
	$text='百度收录推送计划任务执行通知，时间：'.$date;
	send_mail($conf['site_mail'],$conf['site_title'],$text,$path);
    exit('{"code":1,"msg":"推送成功","date":"'.$date.'","remain":"'.$arr['remain'].'","all":"'.count($baidu_post).'","success":"'.$arr['success'].'","fail":"'.$fail.'","path":"'.$path.'"}');
}else{
    exit('{"code":-1,"msg":"未知错误","date":"'.$date.'"}');
}
?>