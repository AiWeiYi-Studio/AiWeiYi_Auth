<?php
include("../system/core/core.php");
$title='后台主页';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
$urls=$DB->count("SELECT count(*) from website_legal where user='{$udata['uid']}'");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold text-center" style="background: linear-gradient(to right,#23b7e5,#04d2bf);">
                        <b>用户信息</b>
                    </div>
                    <div class="panel-body">
                        <li style="font-weight:bold" class="list-group-item">
                            当前用户：<font color="blue"><?php echo $udata['name'];?>&nbsp;（UID：<?php echo $udata['uid'];?>）</font>
                        </li>
                        <li style="font-weight:bold" class="list-group-item">
                            积分余额：<font color="green"><?php echo $udata['integral'];?></font> 分
                        </li>
                        <li style="font-weight:bold" class="list-group-item">
                            钱包余额：<font color="red"><?php echo $udata['money'];?></font> 元&nbsp;&nbsp;<a href="./my_money.php?mod=chongzhi" class="btn btn-xs btn-default">充值</a>
                        </li>
                        <li style="font-weight:bold" class="list-group-item">
                            授权统计：<font color="orange"><?php echo $urls;?></font> 个
                        </li>
                        <li style="font-weight:bold" class="list-group-item">
                            当前时间：<?php echo $date;?>
                        </li>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold text-center" style="background: linear-gradient(to right,#16aad8,#f6a5fb);">
                        <b>公告通知</b>
                    </div>
                    <div class="panel-body">
                        <div class="list-group-item">
                            官网正在开放更新当中！！！
                        </div>
                    </div>
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
<!--消息提示-->
<script src="../assets/LightYear/js/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/lightyear.js"></script>

<script src="../assets/Layer/layer.js"></script>

<?php if($udata['token']==null){?>
<script>
var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_edit_token",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
				    lightyear.notify('当前用户TOKEN为空，已自动生成~', 'success', 3000, 'mdi mdi-spin mdi-emoticon-excited', 'top', 'right');
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
</script>
<?php }?>

</body>
</html>