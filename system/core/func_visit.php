<?php
function RobotsPlusPlus(){
    global $clientip,$date,$DB;
    $url = ($_SERVER['SERVER_PORT']==443?'https://':'http://') . $_SERVER['HTTP_HOST'];
    $url_limit_1 = $_SERVER["SCRIPT_NAME"]; // 当前运行脚本的路径
    $url_limit_2 = $_SERVER["QUERY_STRING"]; // 获取域名?后面的参数
    $text = $_SERVER["HTTP_USER_AGENT"];  // 获取user-agent
    $text_2 = strtolower($text); // 转化$text为小写
    if($url_limit_2){
        $url_limit = $url_limit_1 .'?'.$url_limit_2;
    }else{
        $url_limit = $url_limit_1;
    }
	$url_all = $url.$url_limit;
    if (strpos($text_2,"bot")>-1){
		$type = "Other Crawler";
	}elseif (strpos($text_2,"googlebot")>-1){
		$type = "Google";
	}elseif (strpos($text_2,"mediapartners-google")>-1){
		$type = "Google Adsense";
	}elseif (strpos($text_2,"baiduspider")>-1){
		$type = "Baidu";
	}elseif (strpos($text_2,"sogou spider")>-1){
		$type = "Sogou";
	}elseif (strpos($text_2,"yahoo")>-1){
		$type = "Yahoo!";
	}elseif (strpos($text_2,"msn")>-1){
		$type = "MSN";
	}elseif (strpos($text_2,"ia_archiver")>-1){
		$type = "Alexa";
	}elseif (strpos($text_2,"iaarchiver")>-1){
		$type = "Alexa";
	}elseif (strpos($text_2,"sohu")>-1){
		$type = "Sohu";
	}elseif (strpos($text_2,"sqworm")>-1) {
		$type = "AOL";
	}elseif (strpos($text_2,"yodaoBot")>-1){
		$type = "Yodao";
	}elseif (strpos($text_2,"iaskspider")>-1){
		$type = "Iask";
	}else{
	    $type = "真实用户";
	}
	$sql = "insert into `website_visit` (`date`,`ip`,`type`,`url_limit`,`url_all`,`text`) values ('".$date."','".$clientip."','".$type."','".$url_limit."','".$url_all."','".$text."')";
	if($DB->query($sql)){
	    return true;
	}else{
	    return false;
	}
}
?>