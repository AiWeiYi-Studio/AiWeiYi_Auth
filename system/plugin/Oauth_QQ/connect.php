<?php
include("../../core/core.php");
$callback = $_GET['callback'];
require_once("./lib/QC.conf.php");
require_once("./lib/QC.class.php");
header("Content-type: text/html; charset=utf-8"); 
if($callback){
    $urlCookie = base64_encode($callback);
    setcookie("Moleft_QQLogin_CallBack",$urlCookie);
    $QC = new QC($QC_config);
    $QC->qq_login();
}else{
    exit('回调地址为空');
}
?>