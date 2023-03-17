<?php
include("../system/core/core.php");
$title='邮件发件接口';
$textssss = $conf['site_title'].'邮件发件接口';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
if($conf['api_mail_active']=='0'){
    showmsg('<h4>API已关闭，无法使用</h4>');
}
$请求示例 = ''.$siteurls.'api/api/mail.php?token='.$udata['token'].'&mail='.$udata['mail'].'&title='.$conf['site_title'].'&text='.$textssss.'&file=需要请先上传文件';
$接口地址 = ''.$siteurls.'api/api/mail.php';
$title1='邮件发件接口';
$title2='使用系统接口发送邮件';
?>
<link rel="stylesheet" href="../assets/Layui/css/layui.css">
<script src="../assets/Layui/layui.all.js"></script>
<style>
	.url {
		word-break: break-all;
		cursor: pointer;
		margin-left: 5px;
		color: #777;
		border: none;
		border-radius: 0;
		border-bottom: 2px solid #5FB878;
	}

	.simpleTable {
		line-height: 20px;
		padding-bottom: 16px;
	}

	.linep {
		font-size: 14px;
		font-weight: 700;
		color: #555;
		padding-left: 14px;
		height: 16px;
		line-height: 16px;
		margin-bottom: 18px;
		position: relative;
		margin-top: 15px;
	}

	.linep:before {
		content: '';
		width: 4px;
		height: 16px;
		background: #00aeff;
		border-radius: 2px;
		position: absolute;
		left: 0;
		top: 0;
	}

	::-webkit-scrollbar {
		width: 9px;
		height: 9px
	}

	::-webkit-scrollbar-track-piece {
		background-color: #ebebeb;
		/* -webkit-border-radius: 4px */
	}

	::-webkit-scrollbar-thumb:vertical {
		height: 32px;
		background-color: #ccc;
		/* -webkit-border-radius: 4px */
	}

	::-webkit-scrollbar-thumb:horizontal {
		width: 32px;
		background-color: #ccc;
		/* -webkit-border-radius: 4px */
	}

	.layui-container {
		min-height: 273px;
	}
</style>

    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
          
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4><?php echo $title1;?></h4>
</div>
<div class="card-body">
    

	<div class="layui-row">
		<blockquote class="layui-elem-quote"><?php echo $title2;?></blockquote>
	</div>
	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
		<ul class="layui-tab-title" style="text-align: center!important;">
			<li class="layui-this">API文档</li>
			<li>错误码参照</li>
			<li>示例代码</li>
			<li>说明</li>
			<li>在线调用</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<p class="simpleTable">
					<span class="layui-badge layui-bg-black">接口地址：</span>
					<span class="url" data-clipboard-text="<?php echo $接口地址;?>"><?php echo $接口地址;?></span>
				</p>
				<p class="simpleTable">
					<span class="layui-badge layui-bg-green">返回格式：</span>
					<span class="url" data-clipboard-text="JSON">
						JSON					</span>
				</p>
				<p class="simpleTable">
					<span class="layui-badge">请求方式：</span>
					<span class="url" data-clipboard-text="GET">
						GET					</span>
				</p>
				<p class="simpleTable">
					<span class="layui-badge layui-bg-blue">请求示例：</span>
					<span class="url" data-clipboard-text="<?php echo $请求示例;?>"><?php echo $请求示例;?></span>
				</p>
				<p class="linep">递交参数说明：</p>
				<table class="layui-table" lay-size="sm">
					<thead>
						<tr>
							<th>名称</th>
							<th>必填</th>
							<th>类型</th>
							<th>说明</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>token</td>
							<td>是</td>
							<td>string</td>
							<td>用户唯一TOKEN标识</td>
						</tr>
						<tr>
							<td>mail</td>
							<td>是</td>
							<td>string</td>
							<td>收件邮箱</td>
						</tr>
						<tr>
							<td>title</td>
							<td>是</td>
							<td>string</td>
							<td>邮箱标题</td>
						</tr>
						<tr>
							<td>text</td>
							<td>是</td>
							<td>string</td>
							<td>邮件内容</td>
						</tr>
						<tr>
							<td>file</td>
							<td>否</td>
							<td>string</td>
							<td>邮件附件（只能发送上传至本站的文件）</td>
						</tr>
					</tbody>
				</table>
				<p class="linep">成功返回说明：</p>
                <table class="layui-table" lay-size="sm">
					<thead>
						<tr>
							<th>名称</th>
							<th>类型</th>
							<th>说明</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>code</td>
							<td>string</td>
							<td>返回的状态码</td>
						</tr>
						<tr>
							<td>msg</td>
							<td>string</td>
							<td>返回结果提示信息</td>
						</tr>
						<tr>
							<td>user_money</td>
							<td>string</td>
							<td>调用后用户余额</td>
						</tr>
						<tr>
							<td>api_money</td>
							<td>string</td>
							<td>当前API单价</td>
						</tr>
						<tr>
							<td>mail_user</td>
							<td>string</td>
							<td>收件人邮箱</td>
						</tr>
						<tr>
							<td>mail_title</td>
							<td>string</td>
							<td>邮件标题</td>
						</tr>
						<tr>
							<td>mail_text</td>
							<td>string</td>
							<td>邮件内容</td>
						</tr>
						<tr>
							<td>mail_file</td>
							<td>string</td>
							<td>邮件附件</td>
						</tr>
					</tbody>
				</table>
				<p class="linep">失败返回参数说明：</p>
				<table class="layui-table" lay-size="sm">
					<thead>
						<tr>
							<th>名称</th>
							<th>类型</th>
							<th>说明</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>code</td>
							<td>string</td>
							<td>返回的状态码</td>
						</tr>
						<tr>
							<td>msg</td>
							<td>string</td>
							<td>返回结果提示信息</td>
						</tr>
					</tbody>
				</table>
		</div>
			<div class="layui-tab-item">
				<p class="linep">错误码格式说明：</p>
				<table class="layui-table" lay-size="sm">
					<thead>
						<tr>
							<th>名称</th>
							<th>类型</th>
							<th>说明</th>
						</tr>
					</thead>
					    <tbody>
							<tr>
								    <td>code</td>
								    <td>String</td>
								    <td>返回的状态码 -1/1 失败/成功</td>
							</tr>
							<tr>
								    <td>msg</td>
								    <td>String</td>
								    <td>返回结果提示信息！</td>
							</tr>			
					    </tbody>
				    </table>
			</div>
			<div class="layui-tab-item">
				<p class="linep">请求代码示例：</p>
				<pre class="layui-code">&lt;?php
header("Content-Type:text/html;charset=UTF-8");
date_default_timezone_set("PRC");
$token = '密钥';
$mail = '邮箱';
$title = '标题';
$text = '内容';
$file= '附件';
$result = file_get_contents("<?php echo $siteurls;?>api/api/mail.php?token=".$token."&mail=".$mail."&title=".$title."&text=".$text."&file=".$file."");
$arr=json_decode($result,true);
if ($arr['code']==1) {
    echo $arr['msg'];
} else {
    echo $arr['msg'];
}
?></pre>
				
<p class="linep">成功返回示例：</p>
				<pre class="layui-code">{
				      "code":1,
				      "msg":"发送成功，已扣除用户余额并计入调用总数",
				      "user_money":"0",
				      "api_money":"0",
				      "mail_user":"2874992246@qq.com",
				      "mail_title":"爱唯逸网络科技",
				      "mail_text":"爱唯逸网络科技邮件发件接口"
				      "mail_file":"爱唯逸网络科技邮件发件接口.zip"
				}</pre>
				<p class="linep">失败返回示例：</p>
				<pre class="layui-code">{
				    "code":"-1",
				    "msg":"TOKEN不正确",
				}</pre>
			</div>
		<div class="layui-tab-item">
		    <blockquote class="layui-elem-quote">调用单价：<?php echo $conf['api_mail_money'];?>/次</blockquote>
		    <blockquote class="layui-elem-quote">总调用次数：<?php echo $conf['api_mail_number'];?>/次</blockquote>
		    <blockquote class="layui-elem-quote">违规调用将拉黑绑定QQ、账号与邮箱，余额不退</blockquote>
		    <blockquote class="layui-elem-quote">附件只能在此上传后才能发送</blockquote>
		   </div>
    <div class="layui-tab-item">
        
<div class="form-group">
<label>收件邮箱</label>
<input type="text" id="mail" name="mail" class="form-control" placeholder="收件人邮箱">
</div>

<div class="form-group">
<label>邮件标题</label>
<input type="text" id="title" name="title" class="form-control" placeholder="邮件标题">
</div>

<div class="form-group">
<label>邮件内容</label>
<textarea class="form-control" id="text" name="text" placeholder="邮件内容" rows="4" cols="20"></textarea>
</div>

<div class="form-group">
<label for="file">邮件附件</label>
<input type="file" name="file" id="file" class="form-control">
<br/>
<pre>'png', 'jpg', 'gif', 'jpeg', 'webp', 'bmp', 'zip'</poe>
</div>

<?php if($_GET['file']){?>
<div class="form-group">
<label>附件链接</label>
<input type="text" id="files" class="form-control" value="<?php echo $_GET['file'];?>" placeholder="邮件附带文件功能，需要请先上传文件" disabled="disabled">
</div>
<?php }?>


<div class="text-center">
<a href="javascript:file()" class="btn-round btn btn-info">确定上传</a>
<a href="javascript:api_mail_send()" class="btn-round btn btn-danger">确定发送</a>
</div>
		   </div>
		</div>
	</div>
</div>
<script src="../assets/Api/js/clipboard.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
	layui.use('code', function () { //加载code模块
		layui.code(); //引用code方法
	});
	var clipboard = new ClipboardJS('.url');
	clipboard.on('success', function (e) {
		layer.msg('复制成功!');
	});
	clipboard.on('error', function (e) {
		layer.msg('复制成功!');
	});
</script>

<script>
function file(){
    var fileObj = $("#file")[0].files[0];
    var formData = new FormData();
    formData.append("do","upload");
    formData.append("file",fileObj);
    var ii = layer.msg('正在上传中...', {icon: 16, time: 10 * 1000});
    $.ajax({
        url: "ajax_api.php?act=api_mail_file",
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
							location.href='api_mail.php?file='+data.file;
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
function api_mail_send(){
	var mail=$("#mail").val();
	var title=$("#title").val();
	var text=$("#text").val();
	var files=$("#files").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_api.php?act=api_mail_send",
			data : {mail:mail,title:title,text:text,files:files},
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
<?php 
$path = '../file/mail/'.$udata['uid'].'';
if(!is_dir($path)){
mkdir($path,0777,true);
?>
<script>
layer.msg('系统正在初始化中...', {
    icon: 16,
    time:2000,
    end: function(){
   layer.msg('系统初始化完成...',{
    icon: 1,
    time:2000,})
  }
  });
</script>
<?php }?>
</body>
</html>
