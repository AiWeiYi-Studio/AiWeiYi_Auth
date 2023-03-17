<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : func_send.php
* @Action  : 发短信、发邮件
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function send_dxb($time,$code,$phones)
{
    global $conf;
    $text='【'.$conf['message_title'].'】您的验证码为'.$code.'，验证码在'.$time.'秒内有效。打死都不能告诉告诉任何人哦！';
    $statusStr = array(
        "0"  => "短信发送成功",
        "-1" => "参数不全",
        "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
        "30" => "密码错误",
        "40" => "账号不存在",
        "41" => "余额不足",
        "42" => "帐户已过期",
        "43" => "IP地址限制",
        "50" => "内容含有敏感词"
    );	
    $smsapi = "https://www.smsbao.com/"; //短信网关
    $user = $conf['message_user']; //短信平台帐号
    $pass = md5($conf['message_pass']); //短信平台密码
    $content = $text;//要发送的短信内容
    $phone = $phones;
    $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
    $result =file_get_contents($sendurl) ;
    return $statusStr[$result];
}

function send_mail($mail_user,$mail_title,$mail_text,$mail_file){
    global $conf;
    require ROOT.'system/plugin/PHPMailer/Exception.php';
    require ROOT.'system/plugin/PHPMailer/PHPMailer.php';
    require ROOT.'system/plugin/PHPMailer/POP3.php';
    require ROOT.'system/plugin/PHPMailer/SMTP.php';
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //服务器配置
        $mail->CharSet ="UTF-8";                     //设定邮件编码
        //$mail->SMTPDebug = 0;                        // 调试模式输出
        $mail->isSMTP();                             // 使用SMTP
        $mail->Host = $conf['mail_smtp'];                // SMTP服务器
        $mail->SMTPAuth = true;                      // 允许 SMTP 认证
        $mail->Username = $conf['mail_name'];                // SMTP 用户名  即邮箱的用户名
        $mail->Password = $conf['mail_pwd'];             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
        if($conf['mail_encrypt']!='null'){
            $mail->SMTPSecure = $conf['mail_encrypt'];                    // 允许 TLS 或者ssl协议
        }
        $mail->Port = $conf['mail_port'];                            // 服务器端口 25 或者465 具体要看邮箱服务器支持
        $mail->setFrom($conf['mail_user'],$conf['mail_title']);  //发件人
        $mail->addAddress($mail_user);  // 收件人
        //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
        $mail->addReplyTo($conf['mail_recv']); //回复的时候回复给哪个邮箱 建议和发件人一致
        //$mail->addCC('cc@example.com');                    //抄送
        //$mail->addBCC('bcc@example.com');                    //密送
        
        //发送附件
        if($mail_file && file_exists('../../'.$mail_file)){
            $mail->addAttachment('../../'.$mail_file);// 添加附件
        }
        // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名
        
        //Content
        $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
        $mail->Subject = $mail_title;
        if($conf['mail_template'] == 1){
            $mail->Body  = mail_view_1($mail_text,$mail_user);
        }elseif($conf['mail_template'] == 2){
            $mail->Body  = mail_view_2($mail_text,$mail_user);
        }else{
            $mail->Body  = mail_view_1($mail_text,$mail_user);
        }
        $mail->AltBody = $mail_text;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return $mail->ErrorInfo;
    }
}

function send_mail_api($mail_user,$mail_title,$mail_text,$mail_file,$user_uid,$user_mail){
    global $conf;
    require ROOT.'system/plugin/PHPMailer/Exception.php';
    require ROOT.'system/plugin/PHPMailer/PHPMailer.php';
    require ROOT.'system/plugin/PHPMailer/POP3.php';
    require ROOT.'system/plugin/PHPMailer/SMTP.php';
    
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //服务器配置
        $mail->CharSet ="UTF-8";                     //设定邮件编码
        $mail->SMTPDebug = 0;                        // 调试模式输出
        $mail->isSMTP();                             // 使用SMTP
        $mail->Host = $conf['api_mail_smtp'];                // SMTP服务器
        $mail->SMTPAuth = true;                      // 允许 SMTP 认证
        $mail->Username = $conf['api_mail_name'];                // SMTP 用户名  即邮箱的用户名
        $mail->Password = $conf['api_mail_pwd'];             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
        $mail->SMTPSecure = $conf['api_mail_encrypt'];                    // 允许 TLS 或者ssl协议
        $mail->Port = $conf['api_mail_port'];                            // 服务器端口 25 或者465 具体要看邮箱服务器支持
        $mail->setFrom($conf['api_mail_user'],$conf['site_title']);  //发件人
        $mail->addAddress($mail_user);  // 收件人
        //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
        //$mail->addReplyTo($conf['mail_recv']); //回复的时候回复给哪个邮箱 建议和发件人一致
        //$mail->addCC('cc@example.com');                    //抄送
        //$mail->addBCC('bcc@example.com');                    //密送
        
        //发送附件
        if($mail_file && file_exists('../../file/mail/'.$user_uid.'/'.$mail_file)){
            $mail->addAttachment('../../file/mail/'.$user_uid.'/'.$mail_file);// 添加附件
        }
        // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名
        
        //Content
        $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
        $mail->Subject = $mail_title; //这里是邮件标题
        $mail->Body    = mail_view_api($mail_title,$mail_text,$user_mail);//这里是邮件内容
        $mail->AltBody = $mail_text;//如果邮件客户端不支持HTML则显示此内容
        $mail->send();
        return true;
    } catch (Exception $e) {
        return $mail->ErrorInfo;
    }
}
function send_user_login_mail($mail){
    global $conf,$clientip,$date;
    $title = $conf['site_title'].' - 账户登录通知';
    $text  = '您于'.$date.'在IP为：'.$clientip.'（'.get_ip_city($clientip).'）的地方登录了'.$conf['site_title'].'用户后台，如不是您本人登录则账号可能泄密，请尽快改密！';
    $result = send_mail($mail,$title,$text,null);
    if($result==1){
        return true;
    }else{
        return false;
    }
}
function send_admin_login_mail($mail){
    global $conf,$clientip,$date;
    $title = $conf['site_title'].' - 账户登录通知';
    $text  = '您于'.$date.'在IP为：'.$clientip.'（'.get_ip_city($clientip).'）的地方登录了'.$conf['site_title'].'管理后台，如不是您本人登录则账号可能泄密，请尽快改密！';
    $result = send_mail($mail,$title,$text,null);
    if($result==1){
        return true;
    }else{
        return false;
    }
}
function send_find_mail($mail,$token){
    global $siteurls,$conf,$clientip,$date;
    $title = $conf['site_title'] .'- 密码找回';
	$text = '请您在3分钟内点击下面的认证链接，完成密码找回：<a target="_blank" href="'.$siteurls.'user/login_password.php?token='.$token.'">网页链接</a>，或使用此代码：'.$token.'。过期后请重新获取！';
    $result = send_mail($mail,$title,$text,null);
    if($result==1){
        return true;
    }else{
        return false;
    }
}
function log_notice_mail($mail,$text){
    global $conf;
    $title = $conf['site_title'] .'- 日志提醒';
    $result = send_mail($mail,$title,$text,null);
    if($result==1){
        return true;
    }else{
        return false;
    }
}
function send_workorder_mail_1($id){
	global $DB,$conf,$siteurls;
	$row_1 = $DB->get_row("select * from website_workorder where id = '{$id}' limit 1");
	$row_2 = $DB->get_row("select * from website_user where uid = '{$row_1['user']}' limit 1");
	$title = $conf['site_title'].' - 工单待反馈提醒';
	$text  = '您于'.$row_1['date_add'].'提交的工单（ID：'.$id.'，标题：'.$row_1['title'].'）已被客服回复，目前需要您进一步提供相关信息。请登录网站后台“工单列表”查看详情并回复。<a target="_blank" href="'.$siteurls.'user/workorder_reply.php?id='.$id.'">点此查看</a>';
	if($row_2['mail'] && checkEmail($row_2['mail'])){
	    $result = send_mail($row_2['mail'],$title,$text,null);
	    if($result==1){
	        return true;
	    }else{
	        return false;
	    }
	}else{
	    return false;
	}
}
function send_workorder_mail_2($id){
	global $DB,$conf,$siteurls;
	$row_1 = $DB->get_row("select * from website_workorder where id = '{$id}' limit 1");
	$row_2 = $DB->get_row("select * from website_user where uid = '{$row_1['user']}' limit 1");
	$title = $conf['site_title'].' - 新工单提醒';
	$text  = '用户（'.$row_2['name'].'）于'.$row_1['date_add'].'发起工单（ID：'.$id.'，标题：'.$row_1['title'].'）。请尽快回复！<a target="_blank" href="'.$siteurls.'admin/workorder_reply.php?id='.$id.'">点此查看</a>';
	if($conf['site_mail'] && checkEmail($conf['site_mail'])){
	    $result = send_mail($conf['site_mail'],$title,$text,null);
	    if($result==1){
	        return true;
	    }else{
	        return false;
	    }
	}else{
	    return false;
	}
}
function send_workorder_mail_3($id){
	global $DB,$conf,$siteurls;
	$row_1 = $DB->get_row("select * from website_workorder where id = '{$id}' limit 1");
	$row_2 = $DB->get_row("select * from website_user where uid = '{$row_1['user']}' limit 1");
	$title = $conf['site_title'].' - 工单反馈提醒';
	$text  = '用户（'.$row_2['name'].'）于'.$date.'反馈了工单（ID：'.$id.'，标题：'.$row_1['title'].'）。请尽快回复！<a target="_blank" href="'.$siteurls.'admin/workorder_reply.php?id='.$id.'">点此查看</a>';
	if($conf['site_mail'] && checkEmail($conf['site_mail'])){
	    $result = send_mail($conf['site_mail'],$title,$text,null);
	    if($result==1){
	        return true;
	    }else{
	        return false;
	    }
	}else{
	    return false;
	}
}
?>