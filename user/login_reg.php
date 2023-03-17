<?php
$title='用户注册';
include("../system/core/core.php");
$go_url = daddslashes($_GET['go_url']);
if(!$go_url){
    $go_url = 'index.php';
}
// 获取模板配置信息
$result = file_get_contents(CORE."template/user/reg/".$conf['template_user_reg']."/index.json");
$arr = json_decode($result,true);
// 检测网站状态
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
    }
// 获取模板文件
if(!file_exists(CORE.'template/user/reg/'.$conf['template_user_reg'].'/index.php')){
    include_once CORE.'template/default/register.html';		
}else{
    include_once CORE.'template/user/reg/'.$conf['template_user_reg'].'/index.php';
	}
?>