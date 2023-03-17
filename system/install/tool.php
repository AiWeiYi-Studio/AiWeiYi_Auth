<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

include("../core/config.php");
$token = $_GET['token'];
$tokens = $system['token'];
$mod = isset($_GET['mod'])?$_GET["mod"]:null;
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>解除安装锁定</title>
<link rel="icon" href="../../assets/System/icon/favicon.ico" type="image/ico">
<meta name="author" content="AiWeiYi_Studio">
<link href="../../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<link href="../../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link href="../../assets/LightYear/css/style.min.css" rel="stylesheet">
</head>
  
<body>
  
<div class="container" style="padding-top:60px;">
 <div class="row">
    <div class="col-lg-12">
    
<?php if($mod==null){
if($token=$token){
    $url = '?token='.$token.'&mod=index';
    header('location: ' . $url);
}
?>
 <div class="card">
        <div class="card-header"><h4>解除安装锁定</h4></div>
          <div class="card-body">
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>提示：</strong>请输入系统密钥验证
          </div>
          <?php if($token!==$tokens and $token!==null){?>
          
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>提示：</strong>密钥验证失败！
          </div>
          <?php }?>
                <form action="?" method="GET">
                <div class="form-group has-feedback feedback-left">
                <input type="text" class="form-control" name="token" placeholder="系统密钥">
                </div>
                    <div class="form-group">
                    <input type="submit" class="btn-block btn btn-w-md btn-round btn-danger" value="验证">
                    </div>
                </form>

<!--验证密钥结束-->
<?php }elseif($mod=='index'){
?>
      <div class="card">
        <div class="card-header"><h4>解除安装锁定</h4></div>
          <div class="card-body">
          
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>提示：</strong>功能菜单如下！
          </div>
          <a href="?token=<?php echo $token?>&mod=del" class="btn btn-w-md btn-round btn-info">解除安装</a>
          <a href="?token=<?php echo $token?>&mod=do" class="btn btn-w-md btn-round btn-info">重新上锁</a>
    
    
<?php }elseif($mod=='do'){
@file_put_contents("../../system/install/install.lock",'安装锁');
?>
      <div class="card">
        <div class="card-header"><h4>解除安装锁定</h4></div>
          <div class="card-body">
          
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>提示：</strong>系统上锁成功<a href="?token=<?php echo $token?>&mod=index">返回</a>
          </div>
          

<!--解除安装开始-->
<?php }elseif($mod=='del'){
if(file_exists("../../system/install/install.lock")){
unlink("../../system/install/install.lock");
}
?>
      <div class="card">
        <div class="card-header"><h4>解除安装锁定</h4></div>
          <div class="card-body">
          
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>提示：</strong>解除系统安装锁定成功，目前系统处于危险状态！
          </div>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>提示：</strong>请点击前往安装！<a href="../../system/install">点此安装</a>
          </div>
                    <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>提示：</strong>或者请点击重新上锁！<a href="?token=<?php echo $token;?>&mod=do">点击上锁</a>
          </div>
<?php }?>

<!--解除安装结束-->

      <footer class="text-center">
        <p class="m-b-0">Copyright © <a href="https://www.ukyun.cn">爱唯逸网络科技</a>. All right reserved</p>
      </footer>
      
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="../../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/main.min.js"></script>
</body>
</html>