<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_view.php
* @Action  : 文件管理ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogin==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'size':
    $path = daddslashes($_POST['path']);
    $res = getRealSize(getDirSize($path));
    if($res){
        $result = array(
            "code"=>1,
            "msg"=>$res
        );
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"计算失败"
        );
	}
break;
    
case 'del':
    $path = daddslashes($_POST['path']);
    $result = delpath($path);
    if($result){
        $result = array(
            "code"=>1,
            "msg"=>"删除成功，如果子目录多可能需要删除多次"
        );
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"删除失败"
        );
	}
break;

case 'EditSave':
    $file = daddslashes($_POST['file']);
    $code = $_POST['code'];
    $encoding = daddslashes($_POST['encoding']);
    $file = fopen($file, "w",$encoding);
    if(!$encoding || !$file){
        $result = array(
            "code"=>-1,
            "msg"=>"重要参数缺失"
        );
    }elseif($file){
        $res = fwrite($file, $code);
        if($res){
            $result = array(
                "code"=>1,
                "msg"=>"修改成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"写入失败"
            );
        }
        fclose($file);
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"文件打开失败"
        );
    }
break;

case 'text':
    setlocale(LC_ALL, 'zh_CN.GBK');
    $file = daddslashes($_POST['file']);
    if(file_exists($file)){
        $res = fopen($file, "r");
        if($res){
            $text = fread($res,filesize($file));
            $encode = get_encoding($text);
            $result = array(
                "code"=>1,
                "msg"=>$text?$text:'',
                "encoding"=>$encode,
                "file"=>basename($file)
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"文件打开失败"
            );
        }
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"文件不存在"
        );
	}
break;

default:
    $result = array(
        "code"=>-4,
        "msg"=>"Not Act"
    );
break;
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);