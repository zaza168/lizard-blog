<?php
session_start();
include 'templates/class/global.class.php';
?>
<!DOCTYPE html> 
<head> 
<meta charset=utf-8> 
<title>Lizard的个人博客</title>
<link href="templates/css/footer/advice.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/layer/layer.js"></script>
<script type="text/javascript" src="templates/js/checkadvice.js"></script>

</head> 
<body> 

<header>
意见建议
</header>
 
<article>
<div id="article_main">
<?php
?>
<form id="checkadvice" action="" method="post" onsubmit = "return checkadvice();" >
<div class="label">
联系方式：<input id="input" type="text"  name="tel" value="<?php echo $_COOKIE["tel"];?>">
</div>
<div class="label">
验证码：
<img  title="点击刷新" src="checkcode.php" align="absbottom" onclick="this.src='checkcode.php?'+Math.random();">
<input id="code" maxlength="4" type="text" name="code">
</div>

<div class="label">
建议内容：<br/>
  <textarea  id="input2" name="content" ><?php echo $_COOKIE["content"];?></textarea>
</div>

<input id="advice" type="submit" name="advice" value="提交" >

</form>

</article>

</body> 
</html> 
<?php $g->newadvice();?>