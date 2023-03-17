<?php
session_start();
require './ValidateCode_class.php';
$_vc = new ValidateCode();
$_vc->doimg();
$_SESSION['vc_code'] = $_vc->getCode();
?>