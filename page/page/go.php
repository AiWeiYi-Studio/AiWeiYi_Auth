<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

include("../../system/core/core.php");
$title = '网站跳转';
$url = $_GET['url'];
$back = $_GET['back'];

if(!$url){
    exit("<script language='javascript'>alert('没有跳转地址你想跳去哪？');window.location.href='javascript:history.back(-1)';</script>");
}
if($back){
    $back = $back;
}else{
    $back = 'javascript:history.back(-1)';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title><?php echo $title;?> - <?php echo $conf['site_title'];?></title>
    <link rel="icon" href="../../assets/System/icon/favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
    <meta name="description" content="<?php echo $conf['site_description'];?>">
<style>
body{
    margin:0;padding:0
}
body{
    height:100%
}
#loading{
    -webkit-box-pack:center;
    -ms-flex-pack:center;justify-content:center;
    -webkit-box-align:center;-ms-flex-align:center;align-items:center;
    display:-webkit-box;
    display:-ms-flexbox;
    display:flex;position:fixed;top:0;
    left:0;width:100%;
    height:100%;
    background:#e8eaec
}
.io-black-mode #loading{
    background:#1b1d1f
}
.loading-content{
    position:absolute;
    top:10%;
    padding:0 10px;
    max-width:580px;
    z-index:10000000
}
.flex{
    display:flex
}
.flex-center{
    align-items:center
}
.flex-end{
    display:flex;
    justify-content:flex-end
}
.flex-fill{
    -ms-flex:1 1 auto !important;
    flex:1 1 auto !important
}
.logo-img{
    text-align:center
}
.logo-img img{
    width:200px;
    height:auto;
    margin-bottom:20px
}
.loading-info{
    padding:20px;
    background:#fff;
    border-radius:10px;
    box-shadow:0 15px 20px rgba(18,19,20,.2)
}
.loading-tip{
    background:rgba(255,158,77,.1);
    border-radius:6px;
    padding:5px
}
.loading-text{
    color:#b22e12;
    font-weight:bold
}
.loading-topic{
    padding:20px 0;
    border-bottom:1px solid rgba(136,136,136,.2);
    margin-bottom:20px;font-size:12px;
    word-break:break-all
}
a{
    text-decoration:none
}
.loading-btn,
.loading-btn:active,
.loading-btn:visited{
    color:#fc5531;
    border-radius:5px;
    border:1px solid #fc5531;padding:5px 20px;transition:.3s
}
.loading-btn:hover{
    color:#fff;
    background:#fc5531;box-shadow:0 15px 15px -10px rgba(184,56,25,0.8)
}
.loading-url{
    color:#fc5531
}
.taxt-auto{
    color:#787a7d;font-size:14px
}
.auto-second{
    color:#fc5531;
    font-size:16px;
    margin-right:5px;
    font-weight:bold
}
.warning-ico{
    width:30px;
    height:26px;
    margin-right:5px;
    background-image:url("data:image/svg+xml,%3Csvg class='icon' viewBox='0 0 1024 1024' xmlns='http://www.w3.org/2000/svg' width='32' height='32'%3E%3Cpath d='M872.7 582.6L635.2 177c-53.5-91.3-186.6-88.1-235.6 5.7L187.7 588.3c-46.8 89.7 18.2 197 119.4 197h449.4c104 0 168.8-112.9 116.2-202.7zM496.6 295.2c0-20.5 11.7-31.5 35.1-32.9 22 1.5 33.7 12.5 35.1 32.9V315l-26.4 267.9h-13.2L496.6 315v-19.8zm35.2 406.3c-22-1.5-34.4-13.2-37.3-35.1 1.4-19 13.2-29.3 35.1-30.7 23.4 1.5 36.6 11.7 39.5 30.7-1.5 21.9-13.9 33.6-37.3 35.1z' fill='%23f55d49'/%3E%3C/svg%3E")
}
.io-black-mode .loading-info{
    color:#eee;background:#2b2d2f
}
.io-black-mode .loading-text{
    color:#ff8369
}
@media (min-width:768px){
    .loading-content{
        min-width:450px
    }
}
.imgc {
    background-image: url(../../assets/System/img/bj.jpg);
    background-size: 100% 100%;
    background-repeat: repeat;
    top: 0;
    position: fixed;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -33
}
</style>
</head>
<body class="io-grey-mode">

<div id="loading">
    <div class="imgc"></div>
    <div class="loading-content">
        <div class="logo-img">
            <img src="../../assets/System/img/logo.png">
        </div>
        <div class="loading-info">                        
            <div class="flex flex-center loading-tip">                          
                <div class="warning-ico"></div><div class="loading-text">请注意您的账号和财产安全</div>                        
            </div>                        
            <div class="loading-topic">
                <h3>您即将离开<?php echo $conf['site_title'];?>，去往：<span class="loading-url"><?php echo $url;?></span></h3>
            </div>                        
            <div class="flex flex-center">
                <a class="loading-btn" href="<?php echo $back;?>" rel="external nofollow">返回</a>
                <div class="flex-fill"></div>                     
                <a class="loading-btn" href="<?php echo $url;?>" rel="external nofollow">继续</a>
            </div>                      
        </div>
    </div>
</div>
</body>
</html>