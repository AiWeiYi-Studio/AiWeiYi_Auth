<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : func_get.php
* @Action  : 随机生成需要的值
*/
// 获取文件夹大小
function getDirSize($dir){ 
    $handle = opendir($dir);
    while (false!==($FolderOrFile = readdir($handle))){
        if($FolderOrFile != "." && $FolderOrFile != ".."){
            if(is_dir("$dir/$FolderOrFile")){
                $sizeResult += getDirSize("$dir/$FolderOrFile");
            }else{
                $sizeResult += filesize("$dir/$FolderOrFile");
            }
        }
    }
    closedir($handle);
    return $sizeResult;
}

// 单位自动转换函数
function getRealSize($size){ 
    $kb = 1024;   // Kilobyte
    $mb = 1024 * $kb; // Megabyte
    $gb = 1024 * $mb; // Gigabyte
    $tb = 1024 * $gb; // Terabyte
    if(!$size){
        return "0 B";
    }elseif($size < $kb){
        return $size." B";
    }else if($size < $mb){ 
        return round($size/$kb,2)." KB";
    }else if($size < $gb){ 
        return round($size/$mb,2)." MB";
    }else if($size < $tb){
        return round($size/$gb,2)." GB";
    }else{
        return round($size/$tb,2)." TB";
    }
}

function random($length, $numeric = 0)
{
	$seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? str_replace('0', '', $seed) . '012340567890' : $seed . 'zZ' . strtoupper($seed);
	$hash = '';
	$max = strlen($seed) - 1;
	for ($i = 0; $i < $length; $i++) {
		$hash .= $seed[mt_rand(0, $max)];
	}
	return $hash;
}
function get_km($len = 16)
{
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $strlen = strlen($str);
    $randstr = '';
    for ($i = 0; $i < $len; $i++) {
        $randstr .= $str[mt_rand(0, $strlen - 1)];
    }
    return $randstr;
}
function get_token($len = 16)
{
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $strlen = strlen($str);
    $randstr = '';
    for ($i = 0; $i < $len; $i++) {
        $randstr .= $str[mt_rand(0, $strlen - 1)];
    }
    return $randstr;
}
function get_key($len = 16)
{
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $strlen = strlen($str);
    $randstr = '';
    for ($i = 0; $i < $len; $i++) {
        $randstr .= $str[mt_rand(0, $strlen - 1)];
    }
    return md5($randstr.date("YmdHis").rand(1111,9999));
}
function get_trade_no()
{
    $trade_no=date("YmdHis").rand(1111,9999);
    return $trade_no;
}
function get_code()
{
    $code=rand(111111,999999);
    return $code;
}
function get_authcode($uuid)
{
    $authcode = strtoupper(md5(random(32).$date.$uuid));
    return $authcode;
}
function get_username($len = 16)
{
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $strlen = strlen($str);
    $randstr = '';
    for ($i = 0; $i < $len; $i++) {
        $randstr .= $str[mt_rand(0, $strlen - 1)];
    }
    return $randstr;
}
/**
 * 获取QQ昵称接口
 */
function get_qqname($qq) {
	$api ='https://users.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins='.$qq;
	$data = file_get_contents($api);
	$data = iconv("GB2312", "UTF-8", $data);
	$pattern = '/portraitCallBack\\((.*)\\)/is';
	preg_match($pattern, $data, $result);
	$result = $result[1];
	$result = json_decode($result, true);
	$qqname=$result["$qq"][6];
	if(!$qqname) {
		$name='未知昵称';
	} else {
		$name=$qqname;
	}
	return $name;
}
/**
 * 获取QQ头像接口
 */
function get_qqavatars($qq) {
    global $siteurls;
	$api_1 = 'https://q2.qlogo.cn/headimg_dl?dst_uin='.$qq.'&spec=100';
	$api_2 = 'https://q4.qlogo.cn/g?b=qq&nk='.$qq.'&s=140';
	$api_3 = get_qqavatars_2($qq);
	if(get_curl($api_1)){
	    $avatars = $api_1;
	}elseif(get_curl($api_2)){
	    $avatars = $api_2;
	}elseif(get_curl($api_3)){
	    $avatars = $api_3;
	}else{
	    $avatars = $siteurls.'assets/System/icon/favicon.ico';
	}
	return $avatars;
}
/**
 * 获取QQ头像接口2
 */
function get_qqavatars_2($qq) {
	$api = 'https://ptlogin2.qq.com/getface?appid=1006102&imgtype=3&uin='.$qq;
	$data = file_get_contents($api);
	$data = iconv("GB2312", "UTF-8", $data);
	$pattern = '/pt.setHeader\\((.*)\\)/is';
	preg_match($pattern, $data, $result);
	$result = $result[1];
	$result = json_decode($result, true);
	return $result[$qq];
}
function get_password($len = 16)
{
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$%&';
    $strlen = strlen($str);
    $randstr = '';
    for ($i = 0; $i < $len; $i++) {
        $randstr .= $str[mt_rand(0, $strlen - 1)];
    }
    return $randstr;
}
function get_url_last()
{
    if($_SERVER["QUERY_STRING"]){
        return basename($_SERVER['SCRIPT_NAME']).'?'.$_SERVER["QUERY_STRING"];
    }else{
        return basename($_SERVER['SCRIPT_NAME']);
    }
}
?>