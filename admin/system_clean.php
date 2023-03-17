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
$title='系统清理';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>数据库清理</h4>
                    </div>
                    <div class="card-body">
                        <a href="javascript:log(1)" class="btn btn-block btn-info">清理系统日志</a>
                            <br/>
                        <a href="javascript:log(2)" class="btn btn-block btn-info">清理站长日志</a>
                            <br/>
                        <a href="javascript:log(3)" class="btn btn-block btn-info">清理用户日志</a>
                            <br/>
                        <a href="javascript:kami(1)" class="btn btn-block btn-info">清理充值卡密</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>文件清理</h4>
                    </div>
                    <div class="card-body">
                        <a href="javascript:cron(1)" class="btn btn-block btn-info">清理百度计划任务日志</a>
                        <br/>
                        <a href="javascript:mail_file()" class="btn btn-block btn-info">清理用户邮件附件</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</main>
<!--End 页面主要内容-->

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
function log(type){
layer.confirm('确定清除对应日志吗？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_clean.php?act=clean_log&type="+type+"",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./system_clean.php";
						}, 1000); 
					  }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
    });
};
function kami(type){
layer.confirm('确定清除对应卡密吗？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_clean.php?act=clean_kami&type="+type+"",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./system_clean.php";
						}, 1000); 
					  }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
    });
};
function cron(type){
layer.confirm('确定清除对应文件吗？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_clean.php?act=clean_file_log&type="+type+"",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./system_clean.php";
						}, 1000); 
					  }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
    });
};
function mail_file(){
layer.confirm('确定清除对应文件吗？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_clean.php?act=clean_file_mail",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./system_clean.php";
						}, 1000); 
					  }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
    });
};
</script>

</body>
</html>