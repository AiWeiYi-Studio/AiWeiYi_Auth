<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : func_msg.php
* @Action  : 系统错误显示
*/


function sysmsg($msg = '未知的异常', $die = true){
    global $conf,$siteurls;
    echo "
        <!DOCTYPE html>
        <html>
        <head>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
            <title>此页面发生错误</title>
            <link rel=\"icon\" href=\"/assets/System/icon/favicon.ico\" type=\"image/ico\">
            <meta name=\"keywords\" content=\"".$conf['site_keywords']."\">
            <meta name=\"description\" content=\"".$conf['site_description']."\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <link rel=\"shortcut icon\" href=\"/assets/img/favicon.ico\" />
            <link href=\"/assets/LightYear/css/bootstrap.min.css\" rel=\"stylesheet\">
            <style type=\"text/css\">
                *{
                    box-sizing:border-box;
                    margin:0;
                    padding:0;
                    font-family:Lantinghei SC,Open Sans,Arial,Hiragino Sans GB,Microsoft YaHei,\"微软雅黑\",STHeiti,WenQuanYi Micro Hei,SimSun,sans-serif;
                    -webkit-font-smoothing:antialiased
                }
                body{
                    padding:70px 0;
                    background:#edf1f4;
                    font-weight:400;
                    font-size:1pc;
                    -webkit-text-size-adjust:none;
                    color:#333
                }
                a{
                    outline:0;
                    color:#3498db;
                    text-decoration:none;
                    cursor:pointer
                }
                .system-message{
                    margin:20px 5%;
                    padding:40px 20px;
                    background:#fff;box-shadow:1px 1px 1px hsla(0,0%,39%,.1);
                    text-align:center
                }
                .system-message a{
                    text-decoration:none;
                }
                .system-message h1{
                    margin:0;
                    margin-bottom:9pt;
                    color:#444;
                    font-weight:400;
                    font-size:40px
                }
                .system-message .jump,.system-message .image{
                    margin:20px 0;
                    padding:0;
                    padding:10px 0;
                    font-weight:400
                }
                .system-message .jump{
                font-size:14px
                }
                .system-message .jump a{
                    color:#333
                }
                .system-message p{
                    font-size:9pt;line-height:20px
                }
                .system-message .btn{
                    display:inline-block;
                    margin-right:10px;
                    width:138px;
                    height:2pc;
                    border:1px solid #44a0e8;
                    border-radius:30px;
                    color:#44a0e8;
                    text-align:center;
                    font-size:1pc;
                    line-height:2pc;
                    margin-bottom:5px;
                }
                .success .btn{
                    border-color:#69bf4e;
                    color:#69bf4e
                }
                .error .btn{
                    border-color:#69bf4e;
                    color:#69bf4e
                }
                .info .btn{
                    border-color:#3498db;
                    color:#3498db
                }
                .copyright p{
                    width:100%;
                    color:#919191;
                    text-align:center;
                    font-size:10px
                }
                .system-message .btn-grey{
                    border-color:#bbb;
                    color:#bbb
                }
                .clearfix:after{
                    clear:both;
                    display:block;
                    visibility:hidden;
                    height:0;
                    content:"."
                }
                @media (max-width:768px){
                    body {
                        padding:20px 0;
                    }
                }
                @media (max-width:480px){
                    .system-message h1{
                        font-size:30px;
                    }
                    .size{
                        font-size:10px;
                    }
                }
                .error{
                    border-radius:10px;
                }
                .button {
                    color:rgb(249,250,250);
                    background-color:rgb(109,94,241);
                    border-radius:20px;
                    font-size:15px;
                    text-align:center;
                    padding:5px 15px;
                }
                .button:hover {
                    background-color:red;
                    color:rgb(249,250,250);
                }
            </style>
        </head>
        <body>
            <div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6 center-block\" style=\"float: none;\">
                <div class=\"system-message error\">
                    <div class=\"image\">
                        <img src=\"/assets/System/img/error.svg\" alt=\"SVG\" width=\"100\" />
                    </div>
                    <h4>站点提示信息</h4>
                    <br>
                    <div class=\"size\"style=\"text-align:left;\">
                        ".$msg."
                    </div>
                    <br/>
                    <a href=\"javascript:history.back(-1);\" class=\"button\">返回上一页</a>
                </div>
                <div class=\"system-message error\">
                    Copyright © <a href=\"".$siteurls."\">".$conf['site_copyright'].".</a>
                </div>
            </div>
        </body>
        </html>
    ";
    if ($die == true) {
		exit(0);
	}
}
function showmsg($content = '未知的异常',$head=true,$type = 4,$back = false){
	switch($type){
		case 1:
			$panel="success";
		break;
		case 2:
			$panel="info";
		break;
		case 3:
			$panel="warning";
		break;
		case 4:
			$panel="danger";
		break;
	}
	if($back){
	    $page = '<hr/><a href="'.$back.'"><< 返回上一页</a>';
	}else{
	    $page = '<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a>';
	}
	if($head){
	    echo'
	    <!--页面主要内容-->
	    <main class="lyear-layout-content">
	        <div class="container-fluid">
	    ';
	}
	echo '
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-'.$panel.'">
                        <h4>提示信息</h4>
                    </div>
                    <div class="card-body">
                        <h4>'.$content.'</h4>
                        '.$page.'
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
<script src="../assets/Layer/layer.js"></script>
</body>
</html>
';
exit;
}
?>