<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

include("../../system/core/core.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>API云接口 - <?php echo $conf['site_title'];?></title>
    <style>
         * {margin: 0; padding: 0;} 
         body {background: black;} 
         canvas {display: block;} 
    </style>
</head>
<body>
    <canvas id="ad"></canvas>
    <script>
         var ad = document.getElementById("ad"); 
         var ctx = ad.getContext("2d"); 
         ad.height = window.innerHeight; 
         ad.width = window.innerWidth; 
         var chinese = "<?php echo $conf['site_copyright'];?>"; 
         chinese = chinese.split(""); 
         var font_size = 10; 
         var columns = ad.width / font_size; 
         var drops = []; for (
             var x = 0; x < columns; x++) drops[x] = 1; 
             function draw() { 
                 ctx.fillStyle = "rgba(0, 0, 0, 0.05)"; 
                 ctx.fillRect(0, 0, ad.width, ad.height); 
                 ctx.fillStyle = "#0F0"; 
                 ctx.font = font_size + "px arial"; 
                 for (var i = 0; i < drops.length; i++) { 
                     var text = chinese[Math.floor(Math.random() * chinese.length)]; 
                     ctx.fillText(text, i * font_size, drops[i] * font_size); 
                     if (drops[i] * font_size > ad.height && Math.random() > 0.975) drops[i] = 0; drops[i]++; 
                 } 
             } 
             setInterval(draw, 50); 
    </script>
</body>
</html>