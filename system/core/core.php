<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : core.php
* @Action  : 系统核心文件
*/
error_reporting(0);
define("CACHE_FILE",0);
define("IN_CRONLITE",true);
date_default_timezone_set('PRC');
define("SYSTEM_ROOT",dirname(__FILE__)."/");
define("CORE",dirname(SYSTEM_ROOT)."/");
define("ROOT",dirname(CORE)."/");
define('TIME',time());
//define("SQLITE",false);

$date = date('Y-m-d H:i:s');

if (is_file(CORE.'plugin/AiWeiYi_Safe/webscan.php')) {
    require_once(CORE.'plugin/AiWeiYi_Safe/webscan.php');
}

session_start();
$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT']==443?'https://':'http://') . $_SERVER['HTTP_HOST'].$sitepath.'/';
$siteurls = ($_SERVER['SERVER_PORT']==443?'https://':'http://') . $_SERVER['HTTP_HOST'].'/';

include_once(SYSTEM_ROOT."config.php");
if(!defined("SQLITE") && (!$dbconfig["user"] || !$dbconfig["pwd"] || !$dbconfig["dbname"])){
    echo '您还未安装，<a href="./system/install/">点此安装系统</a>';
	exit(0);
}

include_once(SYSTEM_ROOT."db.class.php");
$DB = new DB($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);
if($DB->query('select * from website_config where 1')==false){
    echo '您尚未安装本程序，请<a href="../system/install/">前往安装</a>';
    exit(0);
}

include(SYSTEM_ROOT."cache.class.php");
$CACHE = new CACHE();
$conf = $CACHE->pre_fetch();

if($conf['site_jump'] == '1' && (!strpos($_SERVER['HTTP_USER_AGENT'],'QQ/') === false || !strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')===false)){
    if($_GET['open'] == 1 && !strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')===false){
        header('Content-Disposition: attachment; filename="load.doc"');
        header('Content-Type: application/vnd.ms-word;charset=utf-8');
    }else{
        header('Content-type:text/html;charset=utf-8');
    }
    require(ROOT."page/page/jump.php");
    exit(0);
}

$password_hash = '!@#%!s!0';
define('SYS_KEY','AiWeiYi');
include_once SYSTEM_ROOT."function.php";
include_once SYSTEM_ROOT."func_view.php";
include_once SYSTEM_ROOT."func_send.php";
include_once SYSTEM_ROOT."func_msg.php";
include_once SYSTEM_ROOT."func_get.php";
include_once SYSTEM_ROOT."func_auth.php";
include_once SYSTEM_ROOT."func_uid.php";
include_once SYSTEM_ROOT."func_del.php";
include_once SYSTEM_ROOT."func_mysql.php";
include_once SYSTEM_ROOT."func_check.php";
include_once SYSTEM_ROOT."func_visit.php";
include_once SYSTEM_ROOT."member.php";
include_once SYSTEM_ROOT."system.php";
include_once SYSTEM_ROOT."version.php";

if($conf['system_visit'] == '1'){
    RobotsPlusPlus();
}

$city=get_ip_city($clientip);

if(!file_exists(CORE."install/install.lock") && file_exists(CORE."install/index.html")){
    sysmsg('<h2>检测到无 install.lock 文件</h2>
    <ul>
    <li><font size="4">如果您尚未安装本程序，请<a href="/system/install/">前往安装</a></font></li>
    <li><font size="4">如果您已经安装本程序，请<a href="/system/install/tool.php">前往上锁</a></font></li>
    <li><font size="4"><b>为了您站点安全，在您完成它之前我们不会工作。</b></font></li>
    </ul>
    <br/>
    <h4>为什么必须建立 install.lock 文件？</h4>如果检测不到它，就会认为站点还没安装，此时任何人都可以安装/重装。<br/><br/>',true);
    exit(0);
}

if ($conf['system_version'] != DB_VERSION && $lock!='666'){
	header('Content-type:text/html;charset=utf-8');
	echo '请先完成网站升级！<a href="/system/update/index.php"><font color=red>点此升级</font></a>';
	exit(0);
}
?>