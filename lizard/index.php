<?php
session_start();
include 'templates/class/global.class.php';
$g->setSql("select * from l_system");
$ss = NULL;
$g->loadObject($ss);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $ss->title2;?></title>
<link rel="stylesheet" type="text/css" href="templates/css/index.css">
<link rel="stylesheet" type="text/css" href="templates/css/font-awesome-4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/layer/layer.js"></script>
<script>
/*登录验证*/
document.getElementById("checklogin").reset(); 
function checklogin(){
var username = document.getElementById("username"); 
  if(username.value.length==0){ 
     layer.tips('请输入账号','#username'); 
     username.focus(); 
     return false; 
  } else
  if(username.value.length<6){ 
   layer.tips('请输入正确的账号','#username');  
   username.focus(); 
     return false; 
  } 
   //验证密码 
   var pass = document.getElementById("password"); 
   if(pass.value.length==0){ 
      layer.tips('请输入密码','#password');  
      pass.focus(); 
      return false; 
    } 
    if(pass.value.length<6){ 
         layer.tips('请输入正确的密码','#password');  
         pass.value = ""; 
         pass.focus(); 
         return false; 
    }
}
</script>

</head>

<body>
<form id="login" method="post" onsubmit = "return checklogin();">
    <h1>后台登陆</h1>
    <input type="text" class="login-input" id="username" name="username" placeholder="管理员账号" >
    <input type="password" class="login-input" id="password" name="password" placeholder="管理员密码">
    <div id="forget">
    	<a href="../index.php"><i class="fa fa-arrow-left  fa-fw"></i>返回主站</a>
    </div>
    <div id="register">
    	<a href="forgot.php">忘记密码<i class="fa fa-arrow-right fa-fw"></i></a>
    </div>
    <input type="submit" value="登陆" name="login" class="login-submit">
    <address>
    <li>
    <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $ss->address;?></a>
    </li>
    </address>
</form>
<?php $g->login();?>
</body>
</html>
