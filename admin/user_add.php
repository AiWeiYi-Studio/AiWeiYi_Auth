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
$title='用户添加';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>用户添加</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">用户账号</label>
                                    <input type="text" id="user" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">用户密码</label>
                                    <input type="text" id="pass" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">用户昵称</label>
                                    <input type="text" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">用户QQ</label>
                                    <input type="text" id="qq" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">用户邮箱</label>
                                    <input type="text" id="mail" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">用户电话</label>
                                    <input type="text" id="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">钱包</label>
                                    <input type="number" id="money" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">积分</label>
                                    <input type="number" id="integral" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">注册IP</label>
                                    <input type="text" id="ip" class="form-control" value="<?php echo $clientip;?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">类型</label>
                                    <select id="type" name="active" class="form-control" default="user">
                                        <option value="admin">站长</option>
                                        <option value="user">用户</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">发言权</label>
                                    <select id="active_chat" name="active" class="form-control" default="1">
                                        <option value="0">禁止</option>
                                        <option value="1">允许</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="text">用户状态</label>
                                    <select id="active" class="form-control" default="1">
                                        <option value="0">禁止登陆</option>
                                        <option value="1">允许登录</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="javascript:add()" class="btn-block btn-round btn btn-success">确定</a>
                        </div>
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
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}
function add(){
	var user=$("#user").val();
	var pass=$("#pass").val();
	var qq=$("#qq").val();
	var name=$("#name").val();
	var mail=$("#mail").val();
	var phone=$("#phone").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_user.php?act=user_add",
			data : {user:user,pass:pass,qq:qq,name:name,mail:mail,phone:phone},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./user_list.php";
						}, 1000); 
					  }
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