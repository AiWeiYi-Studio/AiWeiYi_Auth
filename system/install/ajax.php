<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @Action  : 快捷安装系统ajax
*/
error_reporting(0);

$act=$_GET['act']?$_GET['act']:null;
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    case 'account':
        define("IN_CRONLITE",true);
        include_once('../core/function.php');
        include_once('../core/config.php');
        include_once('../core/db.class.php');
        $DB = new DB($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname'], $dbconfig['port']);
        date_default_timezone_set('PRC');
        $date = date('Y-m-d H:i:s');
        $ip = real_ip();
        $clientip = get_ip_city($ip);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "insert into `website_user` (`user`,`pass`,`reg_time`,`reg_ip`,`reg_city`,`type`) values ('".$username."','".md5($password)."','".$ip."','".$clientip."','".$date."','admin')";
        if(file_exists('install.lock')){
            $result = array(
                "code"=>-1,
                "msg"=>"系统已安装，无法重新安装"
            );
        }elseif(!$username || !$password){
            $result = array(
                "code"=>-1,
                "msg"=>"账号或密码为空"
            );
        }elseif($DB->query($sql)){
            file_put_contents("install.lock",'安装锁');
            $result = array(
                "code"=>1,
                "msg"=>"管理员账号写入成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    break;
    
    case 'mysql':
        require './db.class.php';
        include_once '../core/config.php';
        $sql=file_get_contents("../../system/database/install/install.sql");
        $sql=explode(';',$sql);
        $cn = DB::connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);
        if(file_exists('install.lock')){
            $result = array(
                "code"=>-1,
                "msg"=>"系统已安装，无法重新安装"
            );
        }elseif (!$cn){
            $result = array(
                "code"=>-1,
                "msg"=>DB::connect_error()
            );
        }else{
            DB::query("set sql_mode = ''");
            DB::query("set names 'utf8mb4'");
            $t=0; $e=0;
            for($i=0;$i<count($sql);$i++) {
                if ($sql[$i]=='')continue;
                if(DB::query($sql[$i])) {
                    ++$t;
                } else {
                    ++$e;
                    $error["{$e}"]=DB::error();
                }
            }
            if($e==0){
                $result = array(
                    "code"=>1,
                    "success"=>$t,
                    "fail"=>$e,
                    "msg"=>"安装成功，SQL执行成功".$t."句，失败".$e."句"
                );
            }else{
                $result = array(
                    "code"=>-1,
                    "success"=>$t,
                    "fail"=>$e,
                    "failmsg"=>$error,
                    "msg"=>"安装失败，SQL执行成功".$t."句，失败".$e."句"
                );
            }
        }
    break;
    
    case 'check_mysql':
        require './db.class.php';
        include_once '../core/config.php';
        $post = $_POST['post'];
        if(!$con=DB::connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port'])){
            if(DB::connect_errno()==2002){
                $result = array(
                    "code"=>-1,
                    "msg"=>"连接数据库失败，数据库地址填写错误"
                );
            }elseif(DB::connect_errno()==1045){
                $result = array(
                    "code"=>-1,
                    "msg"=>"连接数据库失败，数据库用户名或密码填写错误"
                );
            }elseif(DB::connect_errno()==1049){
                $result = array(
                "code"=>-1,
                    "msg"=>"连接数据库失败，数据库名不存在"
                );
            }else{
                $result = array(
                    "code"=>-1,
                    "msg"=>"连接数据库失败，[".DB::connect_errno()."]".DB::connect_error()
                );
            }
        }else{
            if(DB::query("select * from website_config where 1")==FALSE && !$post){
                $result = array(
                    "code"=>1,
                    "msg"=>"检测到数据库安装痕迹，可执行安装"
                );
            }elseif(DB::query("select * from website_config where 1")==TRUE && $post){
                $result = array(
                    "code"=>1,
                    "msg"=>"您已确定执行强制安装"
                );
            }else{
                $result = array(
                    "code"=>-1,
                    "msg"=>"您已安装过，全新安装将会清空所有数据，是否继续"
                );
            }
        }
    break;
    
    case 'save_info':
        $db_host=$_POST['db_host'];
        $db_port=$_POST['db_port'];
        $db_user=$_POST['db_user'];
        $db_pwd=$_POST['db_pwd'];
        $db_name=$_POST['db_name'];
        $token=$_POST['token'];
        $config="<?php
/*数据库配置*/
\$dbconfig=array(
    'host' => '{$db_host}', //数据库服务器
    'port' => '{$db_port}', //数据库端口
    'user' => '{$db_user}', //数据库用户名
    'pwd' => '{$db_pwd}', //数据库密码
    'dbname' => '{$db_name}', //数据库名
);
/*系统配置*/
\$system=array(
    'token' => '{$token}', //系统密钥
);
?>";
        if(file_exists('install.lock')){
            $result = array(
                "code"=>-1,
                "msg"=>"系统已安装，无法重新安装"
            );
        }elseif(!$db_host || !$db_port || !$db_user || !$db_pwd || !$db_name || !$token){
            $result = array(
                "code"=>-1,
                "msg"=>"参数不全"
            );
        }elseif(file_put_contents('../core/config.php',$config)){
            $result = array(
                "code"=>1,
                "msg"=>"写入成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"可能没有写入权限"
            );
        }
    break;
    
    case 'check_install':
        if(file_exists('install.lock')){
            $code = 1;
            $msg = "检测到安装锁已存在，如需重新安装请先删除安装锁";
        }else{
            $code = -1;
            $msg = "检测到程序未安装，请先执行安装";
        }
        $result = array(
            "code"=>$code,
            "msg"=>$msg
        );
    break;
    
    case 'check_function':
        if(PHP_VERSION > '5.6'){
            $result['php_version']['code'] = 1;
            $result['php_version']['msg'] = "PHP版本检测正常";
        }else{
            $result["php_version"]['code'] = -1;
            $result['php_version']['msg'] = '<font color="red">PHP版本不能小于5.6</font>';
        }
        if(function_exists(file_get_contents)){
            $result['file_get_contents']['code'] = 1;
            $result['file_get_contents']['msg'] = "file_get_contents()函数支持";
        }else{
            $result['file_get_contents']['code'] = -1;
            $result['file_get_contents']['msg'] = '<font color="red">PHP不支持file_get_contents()函数</font>';
        }
        if(function_exists(curl_exec)){
            $result['curl_exec']['code'] = 1;
            $result['curl_exec']['msg'] = "curl_exec()函数支持";
        }else{
            $result['curl_exec']['code'] = -1;
            $result['curl_exec']['msg'] = '<font color="red">PHP不支持curl_exec()函数</font>';
        };
        if($_SESSION['checksession']=1){
            $result['SESSION']['code'] = 1;
            $result['SESSION']['msg'] = "session支持";
        }else{
            $result['SESSION']['code'] = -1;
            $result['SESSION']['msg'] = '<font color="red">PHP不支持session</font>';
        };
    break;
    
    default:
        $result = array(
            "code"=>-4,
            "msg"=>"Not Act"
        );
    break;
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);