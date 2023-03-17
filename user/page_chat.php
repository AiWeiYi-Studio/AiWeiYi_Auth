<?php
include("../system/core/core.php");
$title='聊天室';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
if($conf['chat_user_active']=='0'){
    showmsg('<h2>'.$conf['chat_user_active_notice'].'</h2>');
}
?>
<link href="../assets/System/chat/style/style.css" rel="stylesheet">
<link href="../assets/System/chat/style/normalize.css" rel="stylesheet">
<style>
    /*定义竖屏 css*/
    @media screen and (orientation:portrait) {
        .page{
            width: 100%;
            height: 500px;
            zoom:1.1;
            background: url('../assets/System/img/bj.jpg');
            background-size: 100% 500px;
            overflow:auto;
        }
	}
	/*定义横屏 css*/
	@media screen and (orientation:landscape) {
	    .page{
            width: 100%;
            height: 430px;
            zoom:1.1;
            background: url('../assets/System/img/bj.jpg');
            background-size: 100% 430px;
            overflow:auto;
        }
	}
</style>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <span class="label label-yellow">聊天室</span>
                            <?php if($conf['chat_user_notice']){?>
                                <span class="label label-info"><?php echo $conf['chat_user_notice'];?></span>
                            <?php }if($udata['active_chat']=='0'){?>
                                <span class="label label-danger">发言违规，已被封禁</span>
                            <?php }?>
                            <span class="label label-danger" data-toggle="modal" data-target="#send_message">点我发言</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="page" id="page">
                            <?php
                                $rs=$DB->query("SELECT * FROM website_chat WHERE active='1' and type='user' order by id asc");
                                while($res = $DB->fetch($rs)){
                                    $row = $DB->get_row("SELECT * FROM website_user WHERE uid='{$res['user']}' limit 1");
                                    if($row['type']=='admin'){
                                        $user = '站长';
                                    }else{
                                        $user = '用户';
                                    }
                                    echo'
                                        <div style="color: white;width: 100%;text-align: center;">'.$res['addtime'].'</div>
                                    ';
                                    if($res['user']==$udata['uid']){
                                        echo'
                                            <div class="me_box fn-clear">
                                                <div class="head_right">
                                                    <a href="javascript:check_avatar('.$res['user'].')">
                                                        <img src="'.$row['avatar'].'">
                                                    </a>
                                                </div>
                                                <div style="color: white;width: 100%;text-align: right;">
                                                    <span class="badge bg-primary">'.$user.'</span>
                                                    <font color="pink">'.$row['name'].'</font>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                                <div class="right_box fn-clear" style="word-break: break-all;">
                                                    <font color="'.$res['colour'].'">'.$res['message'].'</font>
                                                </div>
                                            </div>
                                        ';
                                    }else{
                                        echo'
                                            <div class="you_box fn-clear">
                                                <div class="head">
                                                    <a href="javascript:check_avatar('.$res['user'].')">
                                                        <img src="'.$row['avatar'].'">
                                                    </a>
                                                </div>
                                                <div style="color: white;width: 100%;text-align: left;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <font color="pink">'.$row['name'].'</font>
                                                    <span class="badge bg-info">'.$user.'</span>
                                                </div>
                                                <div class="left_box fn-clear" style="word-break: break-all;">
                                                    <font color="'.$res['colour'].'">'.$res['message'].'</font>
                                                </div>
                                            </div>
                                        ';
                                    }
                                }
                            ?>
                        </div>
                        <br/>
                        <?php if($udata['active_chat']=='1'){?>
                            <div class="modal fade" id="send_message" tabindex="-1" role="dialog" aria-labelledby="send_message">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel">新消息</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="text">字体颜色</label>
                                                <div class="js-colorpicker input-group colorpicker-element">
                                                    <input class="form-control" type="text" id="colour" value="#33cabb">
                                                    <span class="input-group-addon"><i style="background-color: rgb(51, 202, 187);"></i></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">信息内容</label>
                                                <textarea class="form-control" id="message" name="message" placeholder="信息内容" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="form-group">
                                                <a href="javascript:send_message()" class="btn-block btn-round btn btn-info">发送</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
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

<!--颜色选择插件-->
<script src="../assets/LightYear/js/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
function check_avatar(uid){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=get_user_avatar&uid="+uid,
			data : {},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg);
				if(data.code==1){
				    var item = '<div class="text-center">';
				    item += '<img src="'+data.avatar+'">';
				    item += '</div>';
				    layer.open({
				        btn: ['关闭'],
				        area: ['300px', 'auto'],
				        title: '头像大图',
				        shadeClose: true,
				        shade: false,
				        maxmin: true, //开启最大化最小化按钮
				        content: item
				    });
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
};
function send_message(){
	var colour=$("#colour").val();
	var message=$("#message").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=send_message",
			data : {colour:colour,message:message},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
				    setTimeout(function () {
				        location.href="./page_chat.php";
				    }, 1000); //延时1秒跳转
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
};
document.getElementById('page').scrollTop = 99999999999;
var myDiv = document.getElementById('page');myDiv.scrollTop = myDiv.scrollHeight;
$('#page').scrollTop($('#page')[0].scrollHeight);
</script>