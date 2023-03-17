<?php
include("../system/core/core.php");
$title='二维码生成接口';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
if($conf['api_qrcode_active']=='0'){
    showmsg('<h4>API已关闭，无法使用</h4>');
}
$请求示例 = ''.$siteurls.'api/api/qrcode.php?token='.$udata['token'].'&text='.$siteurls.'&size=300';
$接口地址 = ''.$siteurls.'api/api/qrcode.php';
$title1='二维码生成接口';
$title2='提交信息生成二维码';
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
							<td>text</td>
							<td>是</td>
							<td>string</td>
							<td>二维码内容（若生成网址需加前缀）</td>
						</tr>
						<tr>
							<td>size</td>
							<td>否</td>
							<td>string</td>
							<td>生成的二维码大小</td>
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
				<p class="linep">成功返回说明：</p>
		<blockquote class="layui-elem-quote">成功则直接输出二维码，无返回参数</blockquote>
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
				<pre class="layui-code">&lt;iframe src="<?php echo $siteurls;?>api/api/qrcode.php?token=<?php echo $udata['token'];?>&text=测试&size=300" style="width:100%;"&gt;&lt;/iframe&gt;</pre>
<p class="linep">成功返回示例：</p>
				<pre class="layui-code">成功则直接输出二维码，无返回</pre>
				<p class="linep">失败返回示例：</p>
				<pre class="layui-code">{
				    "code":"-1",
				    "msg":"TOKEN不正确",
				}</pre>
			</div>
		<div class="layui-tab-item">
		    <blockquote class="layui-elem-quote">调用单价：<?php echo $conf['api_qrcode_money'];?>/次</blockquote>
		    <blockquote class="layui-elem-quote">总调用次数：<?php echo $conf['api_qrcode_number'];?>/次</blockquote>
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

</body>
</html>