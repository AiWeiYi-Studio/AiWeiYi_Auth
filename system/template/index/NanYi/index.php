<!DOCTYPE html>
<html lang="zh">
<head>
	<title><?php echo $conf['site_title']?> -  <?php echo $title ?></title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="keywords" content="<?php echo $conf['site_keywords']; ?>" />
	<meta name="description" content="<?php echo $conf['site_description']?>">
	<link rel="icon" href="./assets/System/icon/favicon.ico" type="image/ico">
	<link rel="stylesheet" href="../assets/Layui/css/layui.css">
	<link rel="stylesheet" href="<?php echo $arr['assets'];?>/css/main.css">
	<link rel="stylesheet" href="<?php echo $arr['assets'];?>/css/index.css">
	<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
	<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<!-- header -->
	<div class="ew-header">
		<a class="layui-logo" href="/" style="letter-spacing: 1.5px;position: relative;">
			<img src="<?php echo $arr['assets'];?>/images/logo.svg" style="width: 32px;height: 32px;position: absolute;top: 19px;left: 0;">
			<span>
				<?php echo $conf["title"] ?>
			</span>
		</a>
		<div class="ew-nav-group">
			<div class="nav-toggle">
				<i class="layui-icon layui-icon-more-vertical"></i>
			</div>
			<ul class="layui-nav" lay-filter="ew-header-nav">
				<li class="layui-nav-item">
					<a lay-href="/">首页</a>
				</li>
				<?php if($user!=""){?>
				<li class="layui-nav-item nav-btn-login">
					<a href="/User/">立即进入</a>
				</li>
				<?php }else{?>
				<li class="layui-nav-item nav-btn-login">
					<a href="/User/">登录</a>
				</li>
				<li class="layui-nav-item nav-btn-login">
					<a href="/User/?mod=Reg">注册</a>
				</li>
				<?php }?>
			</ul>
		</div>
	</div>
	<!-- banner -->
	<div class="ew-banner" style="margin-top: 15px;">
		<div class="layui-container" style="text-align: left;padding-bottom: 80px;padding-left: 30px;">
			<h1 style="margin-top: 25px;">
				<b>
					<?php echo $conf["title"] ?>
				</b>
			</h1>
			<p style="margin-bottom: 10px;">代码免费加密平台
				<br>快捷，安全，高效，的保护你的代码</p>
			<p>目前已有 <span style="color:red">
					<?php echo $data; ?>
				</span> 个用户选择了我们</p>
			<div class="ew-banner-btngroup" style="margin-top: 40px;">
				<?php if($user!=""){?>
				<a class="layui-btn" href="/User/">立即进入<i class="layui-icon" style="transform: rotate(-90deg);">&#xe601;</i>
				</a>
				<?php }else{?>
				<a class="layui-btn" href="/User/">立即登录<i class="layui-icon" style="transform: rotate(-90deg);">&#xe601;</i>
				</a>
				<a class="layui-btn" href="/User/?mod=Reg">立即注册<i class="layui-icon" style="transform: rotate(-90deg);">&#xe601;</i>
				</a>
			</div>
			<?php }?>
			<img class="shape-main" src="<?php echo $arr['assets'];?>images/NanYi.png"
				 style="width: 520px;position: absolute;top:60px;right: -60px;" />
			<img class="shape layui-anim-rotate layui-anim-loop" src="<?php echo $arr['assets'];?>/images/NanYi1.png"
				 style="position: absolute;right: -120px;top: 260px;" />
			<img class="shape layui-anim-rotate layui-anim-loop" src="<?php echo $arr['assets'];?>/images/NanYi2.png"
				 style="position: absolute;right: 560px;top: 60px;" />
			<img class="shape layui-anim-rotate layui-anim-loop" src="<?php echo $arr['assets'];?>/images/NanYi3.png"
				 style="position: absolute;right: 10px;top: 30px;" />
			<img class="shape shape4 layui-anim-rotate layui-anim-loop" src="<?php echo $arr['assets'];?>/images/NanYi4.png"
				 style="position: absolute;left: -60px;bottom: 100px;" />
			<img class="shape layui-anim-rotate layui-anim-loop" src="<?php echo $arr['assets'];?>/images/NanYi5.png"
				 style="position: absolute;left: -120px;top: 100px;" />
			<img class="shape shape6 layui-anim-rotate layui-anim-loop" src="<?php echo $arr['assets'];?>/images/NanYi6.png"
				 style="position: absolute;left: 300px;top: 400px;" />
		</div>
	</div>

	<!-- feature -->
	<div class="section" style="padding-bottom: 15px;margin-top: 15px;">
		<div class="section-title">
			<h2>为什么选择我们？</h2>
			<p>拥有多年管理系统产品开发经验</p>
		</div>
		<div class="layui-container">
			<div class="layui-row">
				<div class="layui-col-md4 layui-col-sm6">
					<div class="feature">
						<i class="layui-icon layui-icon-fonts-code"></i>
						<h3>PHP混淆加密</h3>
						<p>无需安装组件运行，兼容主流PHP版本，支持主流语法结构。</p>
					</div>
				</div>
				<div class="layui-col-md4 layui-col-sm6">
					<div class="feature">
						<i class="layui-icon layui-icon-app"></i>
						<h3>损耗低 效率高</h3>
						<p>PHP代码多方位重构，性能损耗低，保证加密后代码运行效率。</p>
					</div>
				</div>
				<div class="layui-col-md4 layui-col-sm6">
					<div class="feature">
						<i class="layui-icon layui-icon-cellphone"></i>
						<h3>安全&稳定</h3>
						<p>目前最好的混淆加密算法，算法多变，代码变化万千，最大程度保护您的代码。</p>
					</div>
				</div>
				<div class="layui-col-md4 layui-col-sm6">
					<div class="feature">
						<i class="layui-icon layui-icon-praise"></i>
						<h3>SG11组件加密</h3>
						<p>目前最好的PHP组件加密，解密成本在100-300左右/个。</p>
					</div>
				</div>
				<div class="layui-col-md4 layui-col-sm6">
					<div class="feature">
						<i class="layui-icon layui-icon-rmb"></i>
						<h3>兼容多版本</h3>
						<p>可以自定义PHP5.4-7.2版本，以及自定义版权注释。</p>
					</div>
				</div>
				<div class="layui-col-md4 layui-col-sm6">
					<div class="feature">
						<i class="layui-icon layui-icon-auz"></i>
						<h3>售后保障</h3>
						<p>始终基于主流技术栈</p>
						<p>版本持续更新，集大众所需</p>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- product -->
	<div class="section" nav-id="product">
		<div class="section-title">
			<h2>友情链接</h2>
		</div>
		<div class="layui-container" style="padding-bottom: 60px;">
			<div class="layui-row layui-col-space30">
				<?=$Links['友情链接'];?>
				</div>
			</div>
		</div>
		<!-- pricing -->
		
		<div class="section" nav-id="pricing">
		<div class="section-title">
			<h2>联系站长</h2>
		</div>
		<div class="layui-container" style="padding-bottom: 45px;">
			<blockquote class="layui-elem-quote layui-text" style="margin-top: 35px;">
				客服QQ：（
				<a href="//wpa.qq.com/msgrd?v=3&uin=" .$conf["kfqq"]."&site=qq&menu=yes" target="_blank">
					<?php echo $conf["kfqq"] ?>
				</a>）
				<a href="//wpa.qq.com/msgrd?v=3&uin=" .$conf["kfqq"]."&site=qq&menu=yes" target="_blank">点击联系</a>
			</blockquote>
		</div>
	</div>
	<!-- footer -->
<div class="ew-footer" style="max-width: 100vw;overflow: hidden;">
    <div class="layui-container">
        <div class="layui-row layui-col-space30">
            <div class="layui-col-md6">
                <h3 class="footer-item-title">关于我们</h3>
                <p> <span style="white-space: nowrap;">Copyright © 2017-2022.  Powered by 爱唯逸网络科技. </span></p>
                <p><a href="https://beian.miit.gov.cn/" target="_blank"  rel="nofollow"><img src="https://web.857xx.cn/assets/System/img/beian.jpg" style="height: 2em; ">备案号：桂ICP备20004954号-1</a>
                </p>
            </div>
            <div class="layui-col-md4">
                <h3 class="footer-item-title">联系我们</h3>
                                <p>
                    <i class="layui-icon layui-icon-login-qq"></i>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2322796106&site=qq&menu=yes" target="_blank">咨询在线客服QQ:2322796106</a>
                </p>
                            </div>
            <div class="layui-col-md2">
                <h3 class="footer-item-title">友情链接</h3>
                                <p><a href="http://www.nanyinet.com/" target="_blank">南逸博客</a></p>
                                <p><a href="http://new.nanyinet.com/" target="_blank">新卡主机分销系统</a></p>
                                <p><a href="http://layui.nanyinet.com/" target="_blank">Layui</a></p>
                                <p><a href="http://php.nanyinet.com/" target="_blank">NanYi-PHP</a></p>
                            </div>
        </div>
        <div style="padding: 15px 0;"></div>
    </div>
</div>
<script src="<?php echo $arr['assets'];?>/js/yinghua.js"></script>
<!--鼠标+点击特效-->
<canvas id="fireworks" style="position:fixed;left:0;top:0;pointer-events:none;"></canvas>
<script type="text/javascript" src="<?php echo $arr['assets'];?>/js/anime.min.js"></script>
<script type='text/javascript' src='<?php echo $arr['assets'];?>/js/fireworks.js'></script>
<script>$("body").css("cursor", "url('<?php echo $arr['assets'];?>/normal.cur'), default");
$("a").css("cursor", "url('<?php echo $arr['assets'];?>/link.cur'), pointer");
</script>
<!--鼠标+点击特效结束-->
</body>
</html>