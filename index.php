<?php


session_start();
include 'templates/class/global.class.php';
if($_SESSION["i"]["username"]){
	echo '<meta http-equiv="Refresh" content=0;url="home.php"/>';
	}else{
		echo '<meta content=0;url="index.php"/>';
		}
$g->setSql("select * from l_system");
$ss = NULL;
$g->loadObject($ss);
?>
<!DOCTYPE html> 
<head> 
<meta property="qc:admins" content="24624756221241606375" />
<meta charset=utf-8> 
<title><?php echo $ss->title1;?></title>
<link href="templates/css/index.css" rel="stylesheet" type="text/css"/>
<link href="templates/css/index-footer.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="templates/css/font-awesome-4.3.0/css/font-awesome.min.css">
<script>
var CSSettings = {"pluginPath":"templates"};
</script>
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/layer/layer.js"></script>
<script type="text/javascript" src="templates/js/checkregister.js"></script>
<script type='text/javascript' src='templates/js/modernizr.min.js?ver=2.6.1'></script>
<script type='text/javascript' src='templates/js/cute.slider.js?ver=2.0.0'></script>
<script type='text/javascript' src='templates/js/cute.transitions.all.js?ver=2.0.0'></script>
<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101211861" data-redirecturi="http://lizard168.com/qc_callback.html" charset="utf-8"></script>
</head> 
<body> 

<header>
<div id="logo">
<img src="templates/images/logo/logo.png" width="280" height="100"/>
</div>

</header>
 
<article>
<div id="article_left">

 <div id="cuteslider_3_wrapper" class="cs-circleslight">
<div id="cuteslider_3" class="cute-slider" data-width="700" data-height="393" data-overpause="true">
<ul data-type="slides">
<li data-delay="5" data-src="5" data-trans3d="tr6,tr17,tr22,tr23,tr29,tr27,tr32,tr34,tr35,tr53,tr54,tr62,tr63,tr4,tr13,tr45" data-trans2d="tr3,tr8,tr12,tr19,tr22,tr25,tr27,tr29,tr31,tr34,tr35,tr38,tr39,tr41">
<img  src="templates/images/photo/001/001.jpg">
</li>

<li data-delay="5" data-src="5" data-trans3d="tr6,tr17,tr22,tr23,tr26,tr27,tr29,tr32,tr34,tr35,tr53,tr54,tr62,tr63,tr4,tr13" data-trans2d="tr3,tr8,tr12,tr19,tr22,tr25,tr27,tr29,tr31,tr34,tr35,tr38,tr39,tr41"><img  src="templates/images/photo/bg/blank.png" data-src="templates/images/photo/001/002.jpg" data-thumb="templates/images/photo/001/002a.png">

</li>

<li data-delay="5" data-src="5" data-trans3d="tr6,tr17,tr22,tr23,tr26,tr27,tr29,tr32,tr34,tr35,tr53,tr54,tr62,tr63,tr4,tr13" data-trans2d="tr3,tr8,tr12,tr19,tr22,tr25,tr27,tr29,tr31,tr34,tr35,tr38,tr39,tr41"><img  src="templates/images/photo/bg/blank.png" data-src="templates/images/photo/001/003.jpg" data-thumb="templates/images/photo/001/003a.png">
</li>

</ul>
<ul data-type="controls">
<li data-type="link"></li>
<li data-type="circletimer"></li>
<li data-type="previous"></li>
<li data-type="next"> </li>
<li data-type="bartimer"></li>
<li data-type="slidecontrol" data-thumb="true" data-thumbalign="up"></li>
</ul>
</div>
<div class="cute-shadow"><img src="templates/images/photo/bg/shadow.png" alt="shadow"></div>
</div>

<script type="text/javascript">
var cuteslider3 = new Cute.Slider();cuteslider3.setup("cuteslider_3" , "cuteslider_3_wrapper", "templates/css/slider-style.css");cuteslider3.api.addEventListener(Cute.SliderEvent.CHANGE_START, function(event) { });cuteslider3.api.addEventListener(Cute.SliderEvent.CHANGE_END, function(event) { });cuteslider3.api.addEventListener(Cute.SliderEvent.WATING, function(event) { });cuteslider3.api.addEventListener(Cute.SliderEvent.CHANGE_NEXT_SLIDE, function(event) { });cuteslider3.api.addEventListener(Cute.SliderEvent.WATING_FOR_NEXT, function(event) { });
</script>
</div>
<div id="article_right">
<div id="article_right_title">
个人登陆
</div>
<form action="index.php" id="checklogin" method="post" onsubmit = "return checklogin();">
<div class="label">
账号：<input class="input" type="text" id="username" name="username" >
</div>
<div class="label">
密码：<input class="input" type="password" id="password" name="password">
</div>
<div id="forget">
<a href="forget.php"><i class="fa fa-arrow-left  fa-fw"></i>忘记密码？</a>
</div>
<div id="register">
<a href="register.php">注册账号<i class="fa fa-arrow-right fa-fw"></i></a>
</div>
<input id="login" type="submit" name="login" value="登陆">
</form>

<div id="other">
<div id="other_title">
其他登录方式
</div>
<div id="t">
<span id="qq_login_btn"></span>
<script type="text/javascript">
	QC.Login({//按默认样式插入QQ登录按钮
		btnId:"qq_login_btn"	//插入按钮的节点id
	});
</script>

<!--<!--<a>新浪微博</a>-->
</div>
</div>
</div>
</article>
<?php require_once('index-footer.php');?>
</body> 
</html>
<?php $g->login();?>
