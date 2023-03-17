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
$title = '文件浏览器';
include './page_head.php';
$path_get = daddslashes($_GET['path'])?daddslashes($_GET['path']):'/';
$website  = ($_SERVER['SERVER_PORT']==443?'https://':'http://') . $_SERVER['HTTP_HOST'];
$path = dirname(CORE).$path_get;
$act = daddslashes($_GET['act']);
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>文件浏览器</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>名称</th>
                                        <th>修改时间</th>
                                        <th>权限</th>
                                        <th>所有者</th>
                                        <th>大小</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(is_dir($path)){
                                            $dir = scandir($path);
                                            $i = -2;
                                            $j=0;
                                            $k=0;
                                            if($path_get != '/'){
                                                echo '
                                                    <tr>
                                                        <td>
                                                            <b><a href="javascript:history.back(-1)">Parent directory</a></b>
                                                        </td>
                                                        <td>
                                                            -
                                                        </td>
                                                        <td>
                                                            -
                                                        </td>
                                                        <td>
                                                            -
                                                        </td>
                                                        <td>
                                                            -
                                                        </td>
                                                        <td>
                                                            -
                                                        </td>
                                                    </tr>
                                                ';
                                            }
                                            foreach ($dir as $value){
                                                if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
                                                    $owner = posix_getpwuid(fileowner($path.$value));
                                                    $group = posix_getgrgid(filegroup($path.$value));
                                                } else {
                                                    $owner = array('name' => '?');
                                                    $group = array('name' => '?');
                                                }
                                                if(is_dir($path.$value)){
                                                    $i++;
                                                    $size = '
                                                        <a href="javascript:size(\''.$path.$value.'\','.$i.')" rel="noreferrer" id="size_'.$i.'">计算</a>
                                                    ';
                                                    $jump = '<a href="?path='.$path_get.$value.'/">'.$value.'</a>';
                                                }elseif(is_file($path.$value)){
                                                    $j++;
                                                    $size = getRealSize(filesize($path.$value));
                                                    $k+=filesize($path.$value);
                                                    $jump = $value;
                                                }else{
                                                    $size = null;$jump = null;
                                                }
                                                // 获取文件后缀
                                                $filelast = substr($value, strripos($value, '.') + 1);
                                                $arr = array(
                                                    "pic"=>['png','jpg','jpeg','gif','tiff','bmp','webp'],
                                                    "movie"=>['mp4'],
                                                    "text"=>['php','txt','py','ini','js','css','html','java'],
                                                    "music"=>['mp3']
                                                );
                                                // 检测文件是否支持在线查看
                                                if(in_array($filelast , $arr['pic'])){
                                                    $check = '
                                                        <a href="javascript:pic(\''.$website.$path_get.$value.'\',\''.$value.'\')" class="btn btn-round btn-danger btn-xs">查看</a>
                                                    ';
                                                }elseif(in_array($filelast , $arr['movie'])){
                                                    $check = '
                                                        <a href="javascript:movie(\''.$website.$path_get.$value.'\')" class="btn btn-round btn-danger btn-xs">查看</a>
                                                    ';
                                                }elseif(in_array($filelast , $arr['text'])){
                                                    $check = '
                                                        <a href="javascript:text_check(\''.$path.$value.'\')" class="btn btn-round btn-danger btn-xs">查看</a>
                                                        <a href="javascript:text_edit(\''.$path.$value.'\')" class="btn btn-round btn-danger btn-xs">编辑</a>
                                                    ';
                                                }elseif(in_array($filelast , $arr['music'])){
                                                    $check = '
                                                        <a href="javascript:music(\''.$website.$path_get.$value.'\')" class="btn btn-round btn-danger btn-xs">查看</a>
                                                    ';
                                                }else{
                                                    $check = null;
                                                }
                                                $sub_path =$path .$value;
                                                if($value == '.' || $value == '..'){
                                                    continue;
                                                }else{
                                                    echo '
                                                        <tr>
                                                            <td>
                                                                <b>'.$jump.'</b>
                                                            </td>
                                                            <td>
                                                                '.date("Y-m-d H:i:s",filemtime($path.$value)).'
                                                            </td>
                                                            <td>
                                                                '.$perms = substr(decoct(fileperms($path.$value)), -4).'
                                                            </td>
                                                            <td>
                                                                '.$owner['name'].':'.$group['name'].'
                                                            </td>
                                                            <td>
                                                                '.$size.'
                                                            </td>
                                                            <td>
                                                                <a href="javascript:del(\''.$path.$value.'\')" class="btn btn-round btn-danger btn-xs">删除</a>
                                                                '.$check.'
                                                            </td>
                                                        </tr>
                                                    ';
                                                }
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            所有文件大小: 
                            <span class="badge badge-light">
                                <?php echo getRealSize($k);?>
                            </span>
                            文件: 
                            <span class="badge badge-light">
                                <?php echo $j;?>
                            </span>
                            文件夹: 
                            <span class="badge badge-light">
                                <?php echo $i;?>
                            </span>
                            可用空间: 
                            <span class="badge badge-light">
                                <?php echo getRealSize(disk_free_space($path));?>
                            </span>
                            磁盘大小
                            <span class="badge badge-light">
                                <?php echo getRealSize(disk_total_space($path));?>
                            </span>
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
function pic(img,title){
    json = {
        "title": title, //相册标题
        "id": 1, //相册id
        "start": 0, //初始显示的图片序号，默认0
        "data": [
            {
                "alt": title,
                "pid": 1, //图片id
                "src": img, //原图地址
                "thumb": img //缩略图地址
            }
        ]//相册包含的图片，数组格式
    }
    layer.photos({
        photos: json, //格式见API文档手册页
        anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机
    });
}
function movie(url){
    layer.open({
        type: 2,
        title: '视频播放器',
        shadeClose: true,
        shade: false,
        maxmin: true, //开启最大化最小化按钮
        area: ['60%', '60%'],
        content: 'https://okjx.cc/?url='+url
    });
}
function del(path){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax_view.php?act=del",
		data : {path:path},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			layer.msg(data.msg)
			if(data.code==1){
				setTimeout(function () {
					location.href="";
				}, 1000); 
			}
		},
		error:function(data){
			layer.close(ii);
			layer.msg('服务器错误！');
			return false;
		}
	});
}
function music(url) {
    var item = '<audio controls> <source src="'+url+'"></audio>';
    layer.open({
        type: 1,
        title: '播放器',
        area: ['auto', 'auto'],
        maxmin: true,
        scrollbar: false,
        content: item,
    });
}
function text_check(file) {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_view.php?act=text",
        data : {file:file},
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            if (data.code == 1) {
                var item = '<textarea id="code" style="width:100%;height:500px;" disabled>'+data.msg+'</textarea>';
                layer.open({
                    type: 1,
                    title: '文本查看器 - <font color=red>' + data.file + '</font> - [' + data.encoding + ']',
                    area: ['80%', 'auto'],
                    maxmin: false,
                    scrollbar: false,
                    btn: ['关闭'],
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
function text_edit(file) {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_view.php?act=text",
        data : {file:file},
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            if (data.code == 1) {
                var item = '<div class="form-group col-md-12">';
                item += '<textarea id="code" class="form-control" rows="25">'+data.msg+'</textarea>';
                item += '</div>';
                layer.open({
                    type: 1,
                    title: '编辑器 - <font color=red>' + data.file + '</font> - [' + data.encoding + ']',
                    area: ['80%', 'auto'],
                    maxmin: true,
                    scrollbar: false,
                    btn: ['保存', '关闭'],
                    content: item,
                    btn1: function () {
                        var code = $("#code").val();
                        var load = layer.load(2, {tiem: 99999});
                        $.ajax({
                            type: "POST",
                            url: 'ajax_view.php?act=EditSave',
                            data: {code:code,file:file,encoding:data.encoding},
                            dataType: "json",
                            success: function (data) {
                                layer.close(load);
                                layer.msg(data.msg);
                                if(data.code == 1){
                                    setTimeout(function () {
                                        location.href="";
                                    }, 1000); 
                                }
                            },
                            error: function () {
                                layer.close(load);
                                layer.alert('加载失败！');
                            }
                        });
                    }
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
function size(path,id){
	var ii = layer.msg('正在急速计算中...', {
	    icon: 16,
	    shade: 0.01
	});
	$.ajax({
		type : "POST",
		url : "ajax_view.php?act=size",
		data : {path:path},
		dataType : 'json',
		success : function(data) {
			if(data.code == 1){
			    $("#size_"+id).html(data.msg);
			}else{
			    layer.msg(data.msg);
			}
			layer.close(ii);
		},
		error:function(data){
			layer.close(ii);
			layer.msg('服务器错误！');
			return false;
		}
	});
}
</script>
</body>
</html>