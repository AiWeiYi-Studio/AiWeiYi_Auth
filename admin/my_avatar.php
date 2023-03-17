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
$title='用户信息';
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
                        <h4>头像更换</h4>
                    </div>
                    <div class="card-body">
                        <div class="edit-avatar">
                            <a href="javascript:check_avatar()">
                                <img src="<?php echo $udata['avatar'];?>" alt="<?php echo $udata['name'];?>" class="img-avatar">
                            </a>
                            <div class="avatar-divider"></div>
                            <div class="edit-avatar-content">
                                <p class="m-0">用户昵称：<?php echo $udata['name'];?></p>
                                <br>
                                <p class="m-0">头像数量：<?php echo $udata['avatar_number'];?></p>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label for="file">上传头像（选择后点上传即可）</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="text">头像链接（可输入自定义外链）</label>
                            <input type="text" id="avatar" class="form-control" value="<?php echo $udata['avatar'];?>">
                        </div>
                        <div class="example-box text-center">
                            <a href="javascript:my_avatars()" class="btn-round btn btn-warning">确定修改</a>
                            <a href="javascript:my_avatar()" class="btn-round btn btn-purple">确定上传</a>
                            <a href="javascript:my_avatarss()" class="btn-round btn btn-brown">获取QQ头像</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>历史头像（仅存储上传的头像）</h4>
                    </div>
                    <div class="card-body">
                        <div class="masonry-grid gap-2" data-provide="photoswipe">
                            <?php
                                if(is_dir($path)){
                                    $dir = scandir($path);
                                    foreach ($dir as $value){
                                        $sub_path =$path .'/'.$value;
                                        if($value == '.' || $value == '..'){
                                            continue;
                                        }else{
                                            echo '
                                                <a class="masonry-item" href="'.$siteurls.'file/avatar/'.$udata['uid'].'/'.$value.'" target="blank">
                                                    <img src="'.$path. '/'.$value.'" alt="'.$value.'">
                                                </a>
                                            ';
                                        }
                                    }
                                }
                            ?>
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
function my_avatar(){
    var fileObj = $("#file")[0].files[0];
    var formData = new FormData();
    formData.append("do","upload");
    formData.append("file",fileObj);
    var ii = layer.msg('正在上传头像中...', {icon: 16, time: 10 * 1000});
    $.ajax({
        url: "ajax_my.php?act=my_avatar",
        data: formData,
        type: "POST",
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
						setTimeout(function () {
							location.href="./my_avatar.php";
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
function check_avatar(){
    var item = '<div class="text-center">';
    item += '<img src="<?php echo $udata['avatar'];?>">';
    item += '</div>';
    layer.open({
        btn: ['关闭'],
        area: ['auto', 'auto'],
        title: '头像大图',
        shadeClose: true,
        shade: false,
        maxmin: true, //开启最大化最小化按钮
        content: item
    }); 
}

function my_avatars(){
	var avatar=$("#avatar").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_avatars",
			data : {avatar:avatar},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./my_avatar.php";
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
	
function my_avatarss(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_avatarss",
			data : {},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./my_avatar.php";
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
<?php if(!is_dir($path)){
mkdir($path,0777,true);
?>
<script>
layer.msg('系统正在初始化中...', {
    icon: 16,
    time:2000,
    end: function(){
   layer.msg('系统初始化完成，立即开始上传吧',{
    icon: 1,
    time:2000,})
  }
  });
</script>
<?php }?>

</body>
</html>