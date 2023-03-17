<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : func_uid.php
* @Action  : 修改数据库排序
*/


function Program($_arg_0, $_arg_1 = 0){
	global $DB;
	$_var_3 = $DB->get_row("select * from website_program where id='" . $_arg_0 . "' limit 1");
	$_var_4 = $_var_3["uid"];
	if ($_arg_1 == 1) {
		if ($_var_5 = $DB->get_row("select id,uid from website_program where uid<'" . $_var_4 . "' order by uid desc limit 1")) {
			$DB->query("UPDATE website_program SET uid=" . $_var_5["uid"] . " WHERE id='" . $_arg_0 . "'");
			$DB->query("UPDATE website_program SET uid=" . $_var_4 . " WHERE id='" . $_var_5["id"] . "'");
			return true;
		}
	} elseif ($_arg_1 == 2) {
		if ($_var_5 = $DB->get_row("select id,uid from website_program where uid>'" . $_var_4 . "' order by uid asc limit 1")) {
			$DB->query("UPDATE website_program SET uid=" . $_var_5["uid"] . " WHERE id='" . $_arg_0 . "'");
			$DB->query("UPDATE website_program SET uid=" . $_var_4 . " WHERE id='" . $_var_5["id"] . "'");
			return true;
		}
	} elseif ($_arg_1 == 3) {
		$_var_5 = $DB->get_row("select id,uid from website_program order by uid desc limit 1");
		$DB->query("UPDATE website_program SET uid=uid-1 WHERE uid>" . $_var_4 . '');
		$DB->query("UPDATE website_program SET uid=" . $_var_5["uid"] . " WHERE id='" . $_arg_0 . "'");
		return true;
	} else {
		$_var_5 = $DB->get_row("select id,uid from website_program order by uid asc limit 1");
		$DB->query("UPDATE website_program SET uid=uid+1 WHERE uid<" . $_var_4 . '');
		$DB->query("UPDATE website_program SET uid=" . $_var_5["uid"] . " WHERE id='" . $_arg_0 . "'");
		return true;
	}
	return false;
}
function Article($_arg_0, $_arg_1 = 0){
	global $DB;
	$_var_3 = $DB->get_row("select * from website_article where id='" . $_arg_0 . "' limit 1");
	$_var_4 = $_var_3["uid"];
	if ($_arg_1 == 1) {
		if ($_var_5 = $DB->get_row("select id,uid from website_article where uid<'" . $_var_4 . "' order by uid desc limit 1")) {
			$DB->query("UPDATE website_article SET uid=" . $_var_5["uid"] . " WHERE id='" . $_arg_0 . "'");
			$DB->query("UPDATE website_article SET uid=" . $_var_4 . " WHERE id='" . $_var_5["id"] . "'");
			return true;
		}
	}elseif ($_arg_1 == 2) {
		if ($_var_5 = $DB->get_row("select id,uid from website_article where uid>'" . $_var_4 . "' order by uid asc limit 1")) {
			$DB->query("UPDATE website_article SET uid=" . $_var_5["uid"] . " WHERE id='" . $_arg_0 . "'");
			$DB->query("UPDATE website_article SET uid=" . $_var_4 . " WHERE id='" . $_var_5["id"] . "'");
			return true;
		}
	} elseif ($_arg_1 == 3) {
		$_var_5 = $DB->get_row("select id,uid from website_article order by uid desc limit 1");
		$DB->query("UPDATE website_article SET uid=uid-1 WHERE uid>" . $_var_4 . '');
		$DB->query("UPDATE website_article SET uid=" . $_var_5["uid"] . " WHERE id='" . $_arg_0 . "'");
		return true;
	} else {
		$_var_5 = $DB->get_row("select id,uid from website_article order by uid asc limit 1");
		$DB->query("UPDATE website_article SET uid=uid+1 WHERE uid<" . $_var_4 . '');
		$DB->query("UPDATE website_article SET uid=" . $_var_5["uid"] . " WHERE id='" . $_arg_0 . "'");
		return true;
	}
	return false;
}