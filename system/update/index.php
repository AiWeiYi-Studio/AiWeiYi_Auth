<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

$lock='666';
require_once('../core/core.php');
@header('Content-Type: text/html; charset=UTF-8');
if(!defined("SQLITE") && (!$dbconfig["user"] || !$dbconfig["pwd"] || !$dbconfig["dbname"])){
    echo '您还未安装，<a href="./system/install/">点此安装系统</a>';
	exit(0);
}
if(file_exists('update.lock')){
echo '您已经安装过，如需重新安装请删除安装锁后再安装！<a href="./tool.php">快捷删除</a>';
exit(0);
}

if($conf['system_version']<1000){
	exit('网站程序版本太旧，不支持直接升级');
}elseif($conf['system_version']<1001){
	$version = 1001;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1002){
	$version = 1002;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1003){
    $version = 1003;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1004){
    $version = 1004;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1005){
    $version = 1005;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1006){
    $version = 1006;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1007){
    $version = 1007;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1008){
    $version = 1008;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1009){
    $version = 1009;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1010){
    $version = 1010;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1011){
    $version = 1011;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1012){
    $version = 1012;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1013){
    $version = 1013;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1014){
    $version = 1014;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<1015){
    $version = 1015;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2000){
    $version = 2000;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2001){
    $version = 2001;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2002){
    $version = 2002;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2003){
    $version = 2003;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2005){
    $version = 2005;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2006){
    $version = 2006;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2007){
    $version = 2007;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2008){
    $version = 2008;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2009){
    $version = 2009;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2010){
    $version = 2010;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2012){
    $version = 2012;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2013){
    $version = 2013;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2014){
    $version = 2014;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2015){
    $version = 2015;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2016){
    $version = 2016;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2017){
    $version = 2017;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2018){
    $version = 2018;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2019){
    $version = 2019;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}elseif($conf['system_version']<2020){
    $version = 2020;
	$sqls = file_get_contents('../database/update/'.$version.'.sql');
}else{
    file_put_contents("update.lock",'网站数据库更新锁');
    exit("<script language='javascript'>alert('你的网站已经升级到最新版本了');window.location.href='/';</script>");
}
$explode = explode(';', $sqls);
$num = count($explode);
foreach ($explode as $sql) {
    if ($sql = trim($sql)) {
        $DB->query($sql);
    }
}
saveSetting('system_version',$version);
exit("<script language='javascript'>alert('网站数据库".$version."升级完成！');window.location.href='./';</script>");
?>