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
$title='系统插件列表';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:index;
$path='../system/plugin';
?>

<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>插件列表</h4>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead><tr><th>名称</th><th>标识</th><th>作者</th><th>版本</th><th>介绍</th></tr></thead>
                            <tbody>
                                <?php
                                    if(is_dir($path)){
                                        $dir = scandir($path);
                                            foreach ($dir as $value){
                                                $sub_path = $path .'/'.$value;
                                                if($value == '.' || $value == '..'){
                                                    continue;
                                                }else{
                                                    $row = $DB->get_row("SELECT * FROM website_plugin WHERE path='$value' limit 1");
                                                    $result = file_get_contents("../system/plugin/".$value."/info.json");
                                                    $arr=json_decode($result,true);
                                                    echo '
                                                        <tr>
                                                            <td>
                                                                <img src="'.$arr['icon'].'" width="30px;">
                                                                <a href="javascript:notice('.$row['id'].')">'.$arr['name'].'</a>
                                                            </td>
                                                            <td>'.$value.'</td>
                                                            <td>
                                                                <a href="'.$arr['website'].'">'.$arr['author'].'</a>
                                                            </td>
                                                            <td>'.$arr['version'].'</td>
                                                            <td><b>'.$arr['notice'].'</td>
                                                            <!--
                                                            <td>
                                                                <a href="javascript:del('.$row['id'].')" class="btn btn-danger btn-xs">删除</a>
                                                            </td>
                                                            -->
                                                        </tr>
                                                    ';
                                                }
                                            }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group text-center">
                        <a href="javascript:get()" class="btn-round btn btn-success">更新插件列表</a>
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

<script src="../assets/Layer/layer.js"></script>

<script>
function notice(id){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax_system.php?act=plugin_notice&id="+id+"",
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			layer.open({
                title: '插件介绍',
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

function get(){
layer.confirm('确定？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=plugin_get",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			    if(data.code==1){
					setTimeout(function () {
						location.href="./system_plugin.php";
					}, 1000); 
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('没有新插件');
				return false;
			}
		});
    });
};
/*
function del(id){
layer.confirm('确定？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=plugin_del&id="+id+"",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
				    setTimeout(function () {
					    location.href="./system_plugin.php";
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
*/
</script>

</body>
</html>