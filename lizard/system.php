<?php
session_start();
include 'templates/class/global.class.php';
$g->auth();
$g->setSql("select * from l_system");
$ss = NULL;
$g->loadObject($ss);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $ss->title2;?></title>
<link rel="stylesheet" type="text/css" href="templates/css/system.css">
<link rel="stylesheet" type="text/css" href="templates/css/main.css">
<link rel="stylesheet" type="text/css" href="templates/css/font-awesome-4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/top_menu.js"></script>
<script type="text/javascript" src="templates/js/left_menu.js"></script>
<script type="text/javascript" src="templates/js/layer/layer.js"></script>
<script>
document.getElementById("system").reset(); 
function checksystem(){
var username = document.getElementById("title1"); 
  if(username.value.length==0){ 
     layer.tips('请输入前台题目','#title1',{
		 tips: [2, '#F90'] 
		 }); 
     username.focus(); 
     return false; 
  } 
var username = document.getElementById("title2"); 
  if(username.value.length==0){ 
     layer.tips('请输入后台题目','#title2',{
		 tips: [2, '#F90'] 
		 }); 
     username.focus(); 
     return false; 
  } 


}
</script>
</head>

<body>
<header>
<span id="logo">
<img src="templates/images/logo/logo.png" width="130" height="30" /></div>
</span>
	<nav>
      <li><a href="admin.php"><i class="fa fa-home fa-fw"></i> 首页</a></li>
      <li><a href="article.php"><i class="fa fa-file-text-o fa-fw "></i> 内容</a></li>
       <li><a href="user.php"><i class="fa fa-user fa-fw"></i> 用户</a></li>
      <li class="color"><a href="system.php?id=1"><i class="fa fa-cog fa-fw"></i> 系统</a></li>
	</nav>
	<ul class="user">
		<li>
			<div class="link">你好，<?php $g->menu();?><i class="fa fa-chevron-down fa-fw"></i></div>
			<ul class="user_menu">
				<li><a href="logout.php">退出</a></li>
			</ul>
		</li>
	</ul>
	<!--<div class="search">
		<form class="form-wrapper cf">
			<input type="text" placeholder="请输入关键词..." required>
			<button type="submit"><i class="fa fa-search fa-fw"></i> 搜索</button>
		</form> 
	</div>-->
</header> 
<div class="left_menu">
<ul class="left_menu_a">
    <ul>
		<li>
			<div class="left_menu_title1">
            <i class="fa fa-comments-o fa-fw"></i> 系统管理<i class="fa fa-chevron-up fa-fw"></i></div>
			<ul class="left_menu_sub1">
				<li class="sub1_color"><a href="system.php?id=1">基本管理</a></li>
                <li><a href="http://cp.hichina.com/" target="_blank">主机管理</a></li>
			</ul>
		</li>
	</ul>

</div>
<?php
	$g->setSql("select * from l_system");
	$f = NULL;
	$g->loadObject($f);
?>
<article>
	<div class="article_title">
    基本管理
	</div>
    <form id="system" method = "post" onsubmit = "return checksystem();"/ > 
	<div id="article_right">
    <div id="article_right_main">
    <div id="article_right_main_left">
		前台网站标题：
	</div>
		 <input type="text" class="login-input" id="title1" name="title1" value="<?php echo $f->title1;?>" >
    </div>
    <div id="article_right_main">
    <div id="article_right_main_left">
		后台网站标题：
	</div>
		<input type="text" class="login-input" id="title2" name="title2" value="<?php echo $f->title2;?>" >
    </div>
	<div id="article_right_main">
    <div id="article_right_main_left">
		备案号：
	</div>
		<input type="text" class="login-input" id="address" name="address" value="<?php echo $f->address;?>" >
    </div>
    <div id="article_right_main">
    <div id="article_right_main_left">
		版权说明：
	</div>
		<input type="text" class="login-input" id="copyright" name="copyright" value="<?php echo $f->copyright;?>">
    </div>
    </div>
    <input class="article_button" type="submit" value="提交" name="system"/> 
    </form>
    <?php $g->editsystem();?>
</article>

<footer> 
    <address>
<li><?php echo $ss->copyright;?></li>
<li><a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $ss->address;?></a></li>
    </address>
</footer> 
</body>
</html>
