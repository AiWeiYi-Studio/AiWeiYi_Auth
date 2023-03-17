<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

include("../system/core/core.php");
$title='LOGO配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$path = '../file/avatar/'.$udata['uid'];
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>LOGO配置</h4>
</div>
<div class="card-body">
    <div class="form-group">
<label for="file">上传头像（选择后点上传即可）</label>
<input type="file" name="file" id="file" class="form-control">
<a href="javascript:my_avatar()" class="btn-round btn btn-danger">确定上传</a>
</div>
					<center>
						<font color="green">推荐图片（宽190）（高58）！</font>
						</p>
						<font color="green">以下为当前正使用的图片！</font>
						</p>
						<img src="../assets/System/img//logo.png" style="max-width:20%">
						</p>
					</center>
					<center>
						<br>
						<h4>
							<code>上传后清除缓存即可</code>
						</h4>
					</center>
					<br>
				</div>
			</div>
		</div>
			</div>
</main>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>