<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : index.php
* @Action  : 网站首页文件
*/

// 引入核心文件
include("./system/core/core.php");

// 检测网站开关状态
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}elseif($_GET['mod']){
    // 引入模板自定义模块
    if(file_exists(CORE.'template/index/'.$conf['template_index'].'/controller/'.$_GET['mod'].'.html')){
        include_once CORE.'template/index/'.$conf['template_index'].'/controller/'.$_GET['mod'].'.html';
    }else{
        sysmsg("<b>方法不存在：template\index\\".$conf['template_index']."\controller\\".$_GET['mod'].".html</b>");
    }
}else{
    // 检测模板文件是否存
    if(!file_exists(CORE.'template/index/'.$conf['template_index'].'/index.php')){
        include_once CORE.'template/default/index.html';
    }else{
        // 解析模板配置文件
        if(file_exists(CORE."template/index/".$conf['template_index']."/index.json")){
            $result   = file_get_contents(CORE."template/index/".$conf['template_index']."/index.json");
            $arr      = json_decode($result,true);
        }
        // 页面副标题
        $title    = "查询";
        include_once CORE.'template/index/'.$conf['template_index'].'/index.php';
    }
}
?>
