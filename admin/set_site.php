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
$title='网站信息配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:NULL;
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>网站信息配置</h4>
</div>
<div class="card-body">

<div class="form-group">
<label for="text">网站标题</label>
<input type="text" id="site_title" name="site_title" class="form-control" placeholder="网站主要标题" value="<?=$conf['site_title']?>">
</div>

<div class="form-group">
<label for="text">网站词字</label>
<input type="text" id="site_keywords" name="site_keywords" class="form-control" placeholder="网站关键词字" value="<?=$conf['site_keywords']?>">
</div>

<div class="form-group">
<label for="text">网站信息</label>
<input type="text" id="site_description" name="site_description" class="form-control" placeholder="网站信息" value="<?=$conf['site_description']?>">
</div>

<div class="form-group">
<label for="text">网站版权</label>
<input type="text" id="site_copyright" name="site_copyright" class="form-control" placeholder="网站版权" value="<?=$conf['site_copyright']?>">
</div>

<div class="form-group">
<label for="text">网站备案</label>
<input type="text" id="site_beian" name="site_beian" class="form-control" placeholder="网站备案号" value="<?=$conf['site_beian']?>">
</div>

<div class="form-group">
<label for="text">站点ＱＱ</label>
<input type="text" id="site_qq" name="site_qq" class="form-control" placeholder="网站联系QQ" value="<?=$conf['site_qq']?>">
</div>

<div class="form-group">
<label for="text">站点邮箱</label>
<input type="text" id="site_mail" name="site_mail" class="form-control" placeholder="网站联系邮箱" value="<?=$conf['site_mail']?>">
</div>

<div class="form-group">
<label for="text">站点号码</label>
<input type="text" id="site_phone" name="site_phone" class="form-control" placeholder="网站联系手机" value="<?=$conf['site_phone']?>">
</div>

<div class="form-group">
<label for="text">运营时间</label>
<input class="form-control js-datetimepicker" type="text" id="site_date" placeholder="网站开始时间" value="<?=$conf['site_date']?>" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm" />
</div>

<div class="form-group">
<label for="text">百度推送密钥</label>
<input type="text" id="site_baidu" name="site_baidu" class="form-control" placeholder="百度站长平台推送密钥" value="<?=$conf['site_baidu']?>">
</div>

<div class="form-group">
<label for="text">QQ微信跳转</label>
<select id="site_jump" name="site_jump" class="form-control" default="<?=$conf['site_jump']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div>

<div class="form-group">
<label for="text">全站维护(后台不维护)</label>
<select id="site_active" name="site_active" class="form-control" default="<?=$conf['site_active']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div>

<div class="form-group">
<label for="text">全站访问记录 Ps：<code>打开可能会根据服务器性能影响访问速度</code></label>
<select id="system_visit" name="system_visit" class="form-control" default="<?=$conf['system_visit']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div>

<div class="form-group">
<label for="text">IP获取方式</label>
<select id="site_ip" name="site_ip" class="form-control" default="<?=$conf['site_ip']?>">
<option value="0">0_X_FORWARDED_FOR -- <?php echo real_ip(0);?> -- <?php echo get_ip_city(real_ip(0));?></option>
<option value="1">1_X_REAL_IP -- <?php echo real_ip(1);?> -- <?php echo get_ip_city(real_ip(1));?></option>
<option value="2">2_REMOTE_ADDR -- <?php echo real_ip(2);?> -- <?php echo get_ip_city(real_ip(2));?></option>
</select>
</div>

<div class="form-group">
<a href="javascript:set_site()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>

</div>
</div>
</div>
      
    </main>
    <!--End 页面主要内容-->
  </div>
</div>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<!--时间选择插件-->
<script src="../assets/LightYear/js/bootstrap-datetimepicker/moment.min.js"></script>
<script src="../assets/LightYear/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="../assets/LightYear/js/bootstrap-datetimepicker/locale/zh-cn.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}

function set_site(){
	var site_title=$("#site_title").val();
	var site_keywords=$("#site_keywords").val();
	var site_description=$("#site_description").val();
    var site_beian=$("#site_beian").val();
	var site_copyright=$("#site_copyright").val();
	var site_jump=$("#site_jump").val();
	var site_active=$("#site_active").val();
	var site_qq=$("#site_qq").val();
	var site_mail=$("#site_mail").val();
	var site_phone=$("#site_phone").val();
	var site_date=$("#site_date").val();
	var site_baidu=$("#site_baidu").val();
	var site_ip=$("#site_ip").val();
	var system_visit=$("#system_visit").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_site",
			data : {site_title:site_title,site_keywords:site_keywords,site_description:site_description,site_beian:site_beian,site_copyright:site_copyright,site_jump:site_jump,site_active:site_active,site_qq:site_qq,site_mail:site_mail,site_phone:site_phone,site_date:site_date,site_baidu:site_baidu,site_ip:site_ip,system_visit:system_visit},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
	};
</script>

</body>
</html>