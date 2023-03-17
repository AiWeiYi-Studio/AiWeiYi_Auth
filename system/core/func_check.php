<?php
function checkIfActive($string) {
	$array=explode(',',$string);
	$php_file = basename(($_SERVER['SERVER_PORT']==443?'https://':'http://'). $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'],'.php');
	$php_self=substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],'/')+1,strrpos($_SERVER['REQUEST_URI'],'.')-strrpos($_SERVER['REQUEST_URI'],'/')-1);
	if (in_array($php_self,$array)){
		return 'active';
	}elseif (isset($_GET['mod']) && in_array(str_replace('_n','',$_GET['mod']),$array)){
		return 'active';
	}elseif(in_array($php_file,$array)){
	    return 'active';
	}else{
		return null;
	}
}

function checkIfOpen($string){
	$array=explode(',',$string);
	$php_self=substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],'/')+1,strrpos($_SERVER['REQUEST_URI'],'.')-strrpos($_SERVER['REQUEST_URI'],'/')-1);
	if (in_array($php_self,$array)){
		return 'active';
	}elseif (isset($_GET['mod']) && in_array(str_replace('_n','',$_GET['mod']),$array)){
		return 'active';
	}else
		return null;
}

function checkmobile() {
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$ualist = array('android', 'midp', 'nokia', 'mobile', 'iphone', 'ipod', 'blackberry', 'windows phone');
	if((dstrpos($useragent, $ualist) || strexists($_SERVER['HTTP_ACCEPT'], "VND.WAP") || strexists($_SERVER['HTTP_VIA'],"wap"))){
		return true;
	}else{
		return false;
	}
}
function checkEmail($value)
{
	if (preg_match("/^[\w\.\-]+@\w+([\.\-]\w+)*\.\w+$/", $value) && strlen($value) <= 60) {
		return true;
	} else {
		return false;
	}
}