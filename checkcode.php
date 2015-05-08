<?php
session_start();
include 'templates/class/global.class.php'; //先把类包含进来，实际路径根据实际情况进行修改。
		$_vc = new code();		//实例化一个对象
		$_vc->doimg();		
		$_SESSION['code'] = $_vc->getCode();//验证码保存到SESSION中
?>
