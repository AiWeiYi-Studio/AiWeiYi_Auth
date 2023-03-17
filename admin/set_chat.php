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
$title='聊天室配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:NULL;
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
          
<?php if($mod=='chat_list'){
$numrows=$DB->count("SELECT count(*) from website_chat where type='user'");
?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>聊天记录</h4>
</div>
<div class="card-body">

<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong>系统目前有</strong> <?php echo $numrows;?> <strong>个聊天记录，点击ID查看消息内容</strong>
</div>

<div class="table-responsive">
<table class="table table-striped">
<thead><tr><th>ID</th><th>用户</th><th>时间</th><th>颜色</th><th>IP</th><th>城市</th><th>状态</th><th>操作</th></tr></thead>
<tbody>
    
<?php
$rs=$DB->query("SELECT * FROM website_chat WHERE type='user'");
while($res = $DB->fetch($rs))
{
$row = $DB->get_row("SELECT * FROM website_user WHERE uid='{$res['user']}' limit 1");
if($res['active']=='1'){
    $active='<a href="javascript:set_chat_active('.$res['id'].')" class="btn btn-round btn-info btn-xs">显示</a>';
}else{
    $active='<a href="javascript:set_chat_active('.$res['id'].')" class="btn btn-round btn-danger btn-xs">隐藏</a>';
}
echo '
<td><b><a href="javascript:message('.$res['id'].')">'.$res['id'].'</a></b></td>
<td><a href="javascript:user_info('.$row['uid'].')">'.$row['name'].'</a></td>
<td>'.$res['addtime'].'</td>
<td><font color="'.$res['colour'].'">'.$res['colour'].'</font></td>
<td>'.$res['ip'].'</td>
<td>'.$res['city'].'</td>
<td>'.$active.'</td>
<td>
<a href="javascript:set_chat_del('.$res['id'].')" class="btn btn-round btn-info btn-xs">删除</a>
</td>
</tr>';
}
?>
</tbody>
</table>
</div>
        
<?php }elseif($mod=='chat_set'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户聊天室配置</h4>
</div>
<div class="card-body">

<div class="input-group">
<span class="input-group-addon">聊天室开关</span>
<select id="chat_user_active" name="chat_user_active" class="form-control" default="<?=$conf['chat_user_active']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div><br/>

<div class="input-group">
<span class="input-group-addon">黑名单字词</span>
<textarea class="form-control" id="chat_user_word" name="chat_user_word" placeholder="英文逗号隔开，用户发言触及则禁言，留空则不开启" rows="4"><?php echo htmlspecialchars($conf['chat_user_word']); ?></textarea>
</div><br/>

<div class="form-group">
<a href="javascript:set_chat_user()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>

<?php }?>

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

<script src="../assets/Layer/layer.js"></script>

<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}

function message(id){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax_system.php?act=set_chat_message",
		data : {id:id},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			layer.open({
                title: '信息内容',
                maxWidth: '200',
                btn: '关闭',
                content: data.msg
            });
		},
		error:function(data){
			layer.close(ii);
			layer.msg('服务器错误！');
			return false;
		}
	});
};

function set_chat_user(){
	var chat_user_active=$("#chat_user_active").val();
	var chat_user_word=$("#chat_user_word").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax_system.php?act=set_chat_user",
		data : {chat_user_active:chat_user_active,chat_user_word:chat_user_word},
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
function set_chat_active(id){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_chat_active&id="+id+"",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code == 1){
				   window.location.href='./set_chat.php?mod=chat_list'; 
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
	};
function set_chat_del(id){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_chat_del&id="+id+"",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code == 1){
				   window.location.href='./set_chat.php?mod=chat_list'; 
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
	};

function user_info(uid) {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_user.php?act=user_info&uid=" + uid,
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            if (data.code == 1) {
                var item = '<table class="table table-condensed table-hover" id="accountdetail">';
                item += '<tr><td><b>昵称</b></td><td class="content">' + [data.name] + '</td></tr>';
                item += '<tr><td><b>账号</b></td><td class="content">' + [data.user] + '</td></tr>';
                item += '<tr><td><b>QQ</b></td><td class="content">' + [data.qq] + '</td></tr>';
                item += '<tr><td><b>手机</b></td><td class="content">' + [data.phone] + '</td></tr>';
                item += '<tr><td><b>邮箱</b></td><td class="content">' + [data.mail] + '</td></tr>';
                item += '<tr><td><b>余额</b></td><td class="content">' + [data.money] + '</td></tr>';
                item += '<tr><td><b>积分</b></td><td class="content">' + [data.integral] + '</td></tr>';
                item += '<tr><td><b>注册时间</b></td><td class="content">' + [data.regtime] + '</td></tr>';
                item += '<tr><td><b>登录时间</b></td><td class="content">' + [data.logintime] + '</td></tr>';
                item += '</table>';
                layer.open({
                    type: 1,
                    shadeClose: true,
                    title: '账号详情',
                    skin: 'layui-layer-rim',
                    content: item
                });
            } else {
                layer.msg(data.msg);
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}
</script>

</body>
</html>