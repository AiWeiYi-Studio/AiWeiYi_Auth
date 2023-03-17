<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : func_view.php
* @Action  : 邮件模板
*/

function get_mailname($mail){
    global $conf,$DB;
    $row = $DB->get_row("SELECT * FROM website_user WHERE mail = '{$mail}' limit 1");
    if($mail == $conf['site_mail']){
        $name = '系统管理员';
    }elseif($row){
        $name = $row['name'];
    }else{
        $name = $conf['site_title'].'用户';
    }
    return $name;
}
function mail_view_1($mail_text,$mail_user){
    global $conf,$DB,$siteurls;
    $name = get_mailname($mail_user);
    return '
        <div class="email-body" style="width: 591px; padding: 25px 35px; background: rgb(245, 245, 245); margin: 0px auto;">
            <div class="email-head-logo" style="height: 60px;">
                <span style="font-family: lucida Grande, Verdana, Microsoft YaHei; border-width: initial; border-color: initial; border-image: initial;">
                    <img src="https://web.857xx.cn/assets/System/img/logo_big.png" style="border: none; vertical-align: middle; width: 30px; height: 30px;" modifysize="25%" diffpixels="-1px">&nbsp; 
                </span>
                <span style="font-weight: bold; font-family: 黑体;">
                    <a target="_blank" href="'.$siteurls.'">'.$conf['site_title'].'</a>
                </span>
            </div>
            <div class="email-part-one" style="font-family: lucida Grande, Verdana, Microsoft YaHei; padding: 30px 25px; background: rgb(255, 255, 255); color: rgb(153, 153, 153); font-size: 12px; line-height: 30px;">
            <div>
                <span class="email-bold" style="font-weight: bold; color: rgb(0, 0, 0);">
                    亲爱的'.$name.'：
                </span>
            </div>
            <div class="email-code" style="font-size: 14px; color: rgb(102, 102, 102);">
                <p style="text-indent: 2em;">'.$mail_text.'</p>
            </div>
        </div>
        <div class="email-part-three" style="font-family: lucida Grande, Verdana, Microsoft YaHei; color: rgb(153, 153, 153); margin-top: 15px;">
            <div class="email-copyrights" style="font-size: 10px; color: rgb(198, 198, 198); line-height: 25px; text-size-adjust: none;">
                <center>
                    此为系统邮件，请勿回复 Copyright <a target="_blank" href="'.$siteurls.'">'.$conf['site_copyright'].'</a> All Rights Reserved.
                </center>
            </div>
        </div>
    </div>
    ';
}

function mail_view_2($mail_text,$mail_user){
    global $conf,$DB,$siteurls,$date;
    $name = get_mailname($mail_user);
    return '
	<div style="width:90%; margin:0 auto; background:#fafafa;margin:50px auto;padding:0px;border:0px;outline:0px;border-radius:6px;max-width:696px;overflow:hidden;">
		<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="">
			<tbody>
				<tr bgcolor="#35bdbc" height="80">
					<td width="580" style="line-height:10px;" align="center">
						<span style="font-size:24px; color:#ffffff;"></span><br>
						<span style="color:#ffffff; font-size:36px;"><span><a target="_blank" href="'.$siteurls.'">'.$conf['site_title'].'</a></span></span></td>
				</tr>
			</tbody>
		</table>
		&nbsp;&nbsp;
		<table cellpadding="0" cellspacing="0" border="0" align="center" width="86%" style="">
			<tbody>
				<tr height="20"></tr>
				<tr>
					<td style="">
						<img style="margin-right:5px; " src="https://www.jiankongbao.com/img/report/mark.png"><b>亲爱的'.$name.'：</b>
					</td>
				</tr>
				<tr height="20"></tr>
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" align="center" width="86%" style="background-color: white;">
			<tbody>
				<tr height="20"></tr>
				<tr>
					<td style="" align="left">
						<span style="font-size:10px; color:#000;">' . $mail_text . '</span>
					</td>
				</tr>
				<tr height="20"></tr>
			</tbody>
		</table>
		<table width="100%" cellspacing="0" border="0" cellpadding="0" style="background-color: #fafafa;">
			<tbody>
				<tr>
					<td width="20"></td>
					<td>
						<table width="100%" cellspacing="0" border="0" cellpadding="0">
							<tbody>
								<tr>
									<td height="20"></td>
								</tr>
								<tr>
								</tr>
								<tr>
									<td height="20"></td>
								</tr>
							</tbody>
						</table>
					</td>
					<td width="20"></td>
				</tr>
			</tbody>
		</table>
			<img style="margin-right:5px; " src="https://www.jiankongbao.com/img/report/mark.png"><b>时间： ' . $date . '</b>
		<table width="100%" cellspacing="0" border="0" cellpadding="0" style="background-color: #35bdbc;">
			<tbody>
				<tr>
					<td width="20"></td>
					<td>
						<table width="100%" cellspacing="0" border="0" cellpadding="0">
							<tbody>
								<tr>
									<td height="20"></td>
								</tr>
								<tr>
									<td style="font-size:13px;text-align:center;">此为系统邮件，请勿回复 Copyright <a target="_blank" href="'.$siteurls.'">'.$conf['site_copyright'].'</a> All Rights Reserved.</td>
								</tr>
								<tr>
									<td height="20"></td>
								</tr>
							</tbody>
						</table>
					</td>
					<td width="20"></td>
				</tr>
			</tbody>
		</table>
	</div>
';
}

function mail_view_api($mail_title,$mail_text,$user_mail)
{
    global $conf;
    global $date;
    global $siteurls;
    return '
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>'.$conf['site_title'].'</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>
	<div style="width:90%; margin:0 auto; background:#fafafa;margin:50px auto;padding:0px;border:0px;outline:0px;border-radius:6px;max-width:696px;overflow:hidden;">
		<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="">
			<tbody>
				<tr bgcolor="#35bdbc" height="80">
					<td width="580" style="line-height:10px;" align="center">
						<span style="font-size:24px; color:#ffffff;"></span><br>
						<span style="color:#ffffff; font-size:36px;"><span>'.$mail_title.'</span></span></td>
				</tr>
			</tbody>
		</table>
		&nbsp;&nbsp;
		<table cellpadding="0" cellspacing="0" border="0" align="center" width="86%" style="">
			<tbody>
				<tr height="20"></tr>
				<tr>
					<td style="">
						<img style="margin-right:5px; " src="https://www.jiankongbao.com/img/report/mark.png"><b>邮件内容</b>
					</td>
				</tr>
				<tr height="20"></tr>
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" align="center" width="86%" style="background-color: white;">
			<tbody>
				<tr height="20"></tr>
				<tr>
					<td style="" align="left">
						<span style="font-size:10px; color:#000;">' . $mail_text . '</span>
					</td>
				</tr>
				<tr height="20"></tr>
			</tbody>
		</table>
		<table width="100%" cellspacing="0" border="0" cellpadding="0" style="background-color: #fafafa;">
			<tbody>
				<tr>
					<td width="20"></td>
					<td>
						<table width="100%" cellspacing="0" border="0" cellpadding="0">
							<tbody>
								<tr>
									<td height="20"></td>
								</tr>
								<tr>
								</tr>
								<tr>
									<td height="20"></td>
								</tr>
							</tbody>
						</table>
					</td>
					<td width="20"></td>
				</tr>
			</tbody>
		</table>
		   <img style="margin-right:5px; " src="https://www.jiankongbao.com/img/report/mark.png"><b>发件人： ' . $user_mail . '</b>
		   <br/>
			<img style="margin-right:5px; " src="https://www.jiankongbao.com/img/report/mark.png"><b>时间： ' . $date . '</b>
		<table width="100%" cellspacing="0" border="0" cellpadding="0" style="background-color: #35bdbc;">
			<tbody>
				<tr>
					<td width="20"></td>
					<td>
						<table width="100%" cellspacing="0" border="0" cellpadding="0">
							<tbody>
								<tr>
									<td height="20"></td>
								</tr>
								<tr>
									<td style="font-size:13px;text-align:center;">Copyright &nbsp;© 2020 <strong>'.$conf['site_title'].'</strong>版权所有</td>
								</tr>
								<tr>
									<td style="font-size:10px;text-align:center;"><strong>该邮件使用<a href="'.$siteurls.'">'.$conf['site_title'].'</a>邮箱接口发件，邮件非官方发送！</strong></td>
								</tr>
								<tr>
									<td style="font-size:10px;text-align:center;"><strong>如该邮件违规请发送相关信息到举报：'.$conf['site_mail'].'</strong></td>
								</tr>
								<tr>
									<td height="20"></td>
								</tr>
							</tbody>
						</table>
					</td>
					<td width="20"></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html
';
}
?>