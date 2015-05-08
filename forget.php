<?php
session_start();
include 'templates/class/global.class.php';
$g->setSql("select * from l_system");
$ss = NULL;
$g->loadObject($ss);
?>
<!DOCTYPE html> 
<head> 
<meta charset=utf-8> 
<title><?php echo $ss->title1;?></title>
<link href="templates/css/register.css" rel="stylesheet" type="text/css" />
<link href="templates/css/index-footer.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/layer/layer.js"></script>
<script type="text/javascript" src="templates/js/checkregister.js"></script>
<script type="text/javascript" src="templates/js/passwordStrength.js"></script>
<script>

</script>
</head> 
<body> 

<header>
<div id="logo">
<img src="templates/images/logo/logo.png" width="280" height="100"/>
</div>
</header>
 

<article>
<div id="article_left2">
<div id="article_left_title">
用户协议
</div>
<div id="article_main">
<div id="article_user2">
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
asdasdasdasda</br>
</div>
</div>
</div>
<div id="article_right">
<div id="article_right_title">
修改密码
</div>

<form id="checkregister" action=""  method="post" onsubmit = "return checkregister();">
<div class="label">
账号：<input class="input" type="text" id="username" name="username" >
</div>
<div class="label">
邮箱地址：<input class="input" type="text" id="email" name="email">
</div>
<div class="label">
密码：<input class="input" type="password" id="password" name="password">
<div id="passwordStrengthDiv" class="is0"></div> 
</div>
<div class="label">
密码确认：<input class="input" type="password" id="password2" name="password2">
</div>

<div class="label">
验证码：
<img  title="点击刷新" src="checkcode.php" align="absbottom" onclick="this.src='checkcode.php?'+Math.random();">
<input id="code" maxlength="4" type="text" name="code">

</div>

<div id="login">
<a href="index.php">返回登录></a>
</div>
<input id="forget" type="submit" name="forget" value="修改">

</form>

</div>
</article>
<?php require_once('index-footer.php');?>
</body> 
</html> 
<?php $g->editpassword();?>


