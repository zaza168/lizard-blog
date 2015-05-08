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
 document.getElementById("checkforgot").reset(); 
  function checkforgot(){ 
      //验证邮箱   
    var objName = document.getElementById("email"); 
    var pattern = /^[a-zA-Z0-9]{1,}@[a-zA-Z0-9]{1,10}[.](com|cn|net)$/;   
    if(objName.value==0){ 
       layer.tips('请输入您的邮箱','#email');
       objName.focus(); 
       return false; 
    } 
    if (!pattern.test(objName.value)) {   
           layer.tips('邮箱格式不正确','#email');
           objName.focus(); 
           return false;   
          } 
  //验证用户名 
  var username = document.getElementById("username"); 
  if(username.value.length==0){ 
    layer.tips('账户不能为空','#username');  
     username.focus(); 
     return false; 
  } else
  if(username.value.length<6){ 
  layer.tips('账户不能小于6位','#username');   
   username.value = ""; 
   username.focus(); 
     return false; 
  } 
   //验证密码，确认密码 
   var pass = document.getElementById("password"); 
   var qrpass = document.getElementById("password2"); 
   if(pass.value.length==0){ 
      layer.tips('密码不能为空','#password');  
      pass.focus(); 
      return false; 
    } 
    if(pass.value.length<6){ 
          layer.tips('密码不能小于6位','#password');
         pass.value = ""; 
         pass.focus(); 
         return false; 
    }else if(pass.value!=qrpass.value){ 
      layer.tips('密码不一致','#password2');
     qrpass.value = ""; 
     qrpass.focus(); 
      return false; 
    } 
 }
</script>
</head>

<body>
<form id="forgot" method="post" onsubmit = "return checkforgot();">
    <h1>后台密码修改</h1>
    <input type="text" class="login-input" id="email" name="email" placeholder="邮箱" >
    <input type="text" class="login-input" id="username" name="username" placeholder="账号" >
    <input type="password" class="login-input" id="password" name="password" placeholder="新密码">
    <input type="password" class="login-input" id="password2" name="password2" placeholder="新密码确认">
    <div id="forget">
    	<a href="../index.php"><i class="fa fa-arrow-left fa-fw"></i>返回主站</a>
    </div>
    <div id="register">
    	<a href="index.php">返回登陆<i class="fa fa-arrow-right fa-fw"></i></a>
    </div>
    <input type="submit" value="提交" class="login-submit" name="forgot">
    <address>
    <li>
    <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $ss->address;?></a>
    </li>
    </address>
</form>
<?php $g->editpassword();?>
</body>
</html>
