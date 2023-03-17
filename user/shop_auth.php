<?php
include("../system/core/core.php");
$title='授权商城';
include './page_head.php';
$mod=daddslashes($_GET['mod'])?daddslashes($_GET["mod"]):index;
$app = $_GET['app'];
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
if($udata['qq']){
    $contact = $udata['qq'];
}elseif($udata['mail']){
    $contact = $udata['mail'];
}elseif($udata['phone']){
    $contact = $udata['phone'];
}
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <?php if($mod=='index'){?>
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
                    <div class="card">
                        <div class="card-header">
                    <h4>程序购买</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="text">程序</label>
                            <select id="app" class="form-control" onChange="select_app();" default="<?php echo $app;?>">
                                <option value="0">请选择程序</option>
                                <?php
                                    $rs=$DB->query("SELECT * FROM website_app WHERE status = '1' order by id asc");
                                    while($res = $DB->fetch($rs)){
                                        echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">时间</label>
                            <select id="time" class="form-control" onChange="select_time();">
                                <option value="long">请选择授权时间</option>
                                <option id="day" value="day">一天</option>
                                <option id="month" value="month">一月</option>
                                <option id="year" value="year">一年</option>
                                <option id="long" value="long">永久</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">售价</label>
                            <input type="text" id="money" class="form-control" value="0.00" disabled="disabled" />
                        </div>
                        <div class="form-group">
                            <label for="text">识别码</label>
                            <input type="text" id="uuid" class="form-control" placeholder="输入唯一识别码或域名（不要填写http://和/）">
                        </div>
                        <div class="form-group">
                            <label for="text">联系方式</label>
                            <input type="text" id="contact" class="form-control" value="<?php echo $contact;?>">
                        </div>
                        <div id="miaoshu" style="display:none;">
                            <div class="form-group">
                                <label for="text">程序描述</label>
                                <li id="miaoshu_1"style="word-break:break-all;color:red;"></li>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="example-box text-center">
                                <?php if($conf['pay_alipay_api']!='0'){?>
                                    <a href="javascript:buy(1)" class="btn btn-default"><img src="../assets/System/icon/alipay.ico" width="15" height="17"    >支付宝</a>
                                <?php }if($conf['pay_qqpay_api']!='0'){?>
                                    <a href="javascript:buy(2)" class="btn btn-default"><img src="../assets/System/icon/qqpay.ico">QQ钱包</a>
                                <?php }if($conf['pay_wxpay_api']!='0'){?>
                                    <a href="javascript:buy(3)" class="btn btn-default"><img src="../assets/System/icon/wechat.ico">微信支付</a>
                                <?php }if($udata['money']){?>
                                    <a href="javascript:buy(4)" class="btn btn-default"><img src="../assets/System/icon/favicon.ico" width="17px">余额(<?php echo $udata['money'];?>)</a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($mod=='return'){
            $trade_no=daddslashes($_GET['trade_no']);
            $legal=daddslashes($_GET['legal']);
            $row_pay = $DB->get_row("SELECT * FROM website_pay WHERE trade_no = '".$trade_no."' limit 1");
            $row_legal = $DB->get_row("SELECT * FROM website_legal WHERE id = '".$legal."' limit 1");
            if($row_pay['status']=='1' && $row_pay['buy'] == $legal && $row_pay['user'] == $row_legal['user'] && $row_pay['user'] == $udata['uid'] && $row_legal['user'] == $udata['uid']){
                $sql_update ="update website_legal set active='1' where id='".$legal."'";
                if($DB->query($sql_update)){
                    echo '<meta charset="utf-8"/><script>alert("购买成功，即将跳转");window.location.href="./auth_list.php";</script>';
                }else{
                    echo '<meta charset="utf-8"/><script>alert("'.$DB->error().'");window.location.href="./my_pay.php";</script>';
                }
            }else{
                echo '<meta charset="utf-8"/><script>alert("检测到有诈，即将跳转");window.location.href="./my_pay.php";</script>';
            }
        }?>
    </div>
</main>



<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>


<script src="../assets/Layer/layer.js"></script>

<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default") || 0);
}
function select_app() {
    var app = document.getElementById("app").value;
    var ii = layer.load(0, {shade:[0.1,'#fff']});
    get_text(app);
    get_time_active(app);
    layer.close(ii);
}
function select_time() {
    var app = document.getElementById("app").value;
    var time = document.getElementById("time").value;
    var ii = layer.load(0, {shade:[0.1,'#fff']});
    if(app == 0){
        layer.close(ii);
        layer.msg("请先选择程序");
    }else{
        $.ajax({
            type : "POST",
            url : "ajax_shop.php?act=get_auth_money",
            data : {
                app:app,
                time:time
            },
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code==1){
                    document.getElementById("money").value = data.money;
                }else{
                    layer.msg(data.msg);
                }
            },
            error:function(data){
                layer.close(ii);
                layer.msg('服务器错误！');
                return false;
            }
        });
    }
}
// 获取后台设置调整时间选项隐藏
function get_time_active(app) {
    $.ajax({
        type : "POST",
        url : "ajax_shop.php?act=get_auth_time_active",
        data : {
            app:app
	    },
	    dataType : 'json',
	    success : function(data) {
	        if(data.code==1){
	            // 如果后台设置金额为-1.00则关闭相应选项
	            if(data.day == '-1.00'){
	                document.getElementById("day").style.display="none";
	            }
	            if(data.month == '-1.00'){
	                document.getElementById("month").style.display="none";
	            }
	            if(data.year == -'1.00'){
	                document.getElementById("year").style.display="none";
	            }
	            if(data.long == '-1.00'){
	                document.getElementById("long").style.display="none";
	            }
	        }else{
	            layer.msg(data.msg);
	        }
	    },
	    error:function(data){
	        layer.close(ii);
	        layer.msg('服务器错误！');
	        return false;
	    }
    });
}
function get_text(app) {
    $.ajax({
        type : "POST",
        url : "ajax_shop.php?act=get_auth_text",
        data : {
            app:app
	    },
	    dataType : 'json',
	    success : function(data) {
	        if(data.code==1){
	            document.getElementById("miaoshu").style.display="inline";
	            document.getElementById("miaoshu_1").innerHTML = data.text;
	        }else{
	            layer.msg(data.msg);
	            document.getElementById("miaoshu").style.display="none";
	        }
	    },
	    error:function(data){
	        layer.close(ii);
	        layer.msg('服务器错误！');
	        return false;
	    }
    });
}
function buy(type){
    layer.confirm('确定购买吗？',{
        btn:['确定','取消'],
        closeBtn:0,
        icon:3
    },
    function(){
        var ii = layer.load(0, {shade:[0.1,'#fff']});
	    var app=$("#app").val();
	    var uuid=$("#uuid").val();
	    var contact=$("#contact").val();
	    var time=$("#time").val();
	    $.ajax({
	    	type : "POST",
	    	url : "ajax_shop.php?act=shop_auth",
	    	data : {
	    	    app:app,
	    	    uuid:uuid,
	    	    contact:contact,
	    	    type:type,
	    	    time:time
	    	},
	    	dataType : 'json',
	    	success : function(data) {
	    		layer.close(ii);
	    		layer.msg(data.msg)
	    		if(data.code==1){
	    		    setTimeout(function () {
	    		        location.href=data.url;
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