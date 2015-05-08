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
<link rel="stylesheet" type="text/css" href="templates/css/select.css">
<link rel="stylesheet" type="text/css" href="templates/css/main.css">
<link rel="stylesheet" type="text/css" href="templates/css/font-awesome-4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/top_menu.js"></script>
<script type="text/javascript" src="templates/js/left_menu.js"></script>
<script type="text/javascript" src="templates/js/select.js"></script>
</head>

<body>
<header>
<span id="logo">
<img src="templates/images/logo/logo.png" width="130" height="30" /></div>
</span>
	<nav>
      <li><a href="admin.php"><i class="fa fa-home fa-fw"></i> 首页</a></li>
      <li><a href="article.php"><i class="fa fa-file-text-o fa-fw "></i> 内容</a></li>
       <li class="color"><a href="user.php"><i class="fa fa-user fa-fw"></i> 用户</a></li>
      <li><a href="system.php?id=1"><i class="fa fa-cog fa-fw"></i> 系统</a></li>
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
            <i class="fa fa-list-ul fa-fw"></i> 用户管理<i class="fa fa-chevron-up fa-fw"></i></div>
			<ul class="left_menu_sub1">
				<li><a href="user.php">所有用户</a></li>
                <li class="sub1_color"><a href="edituser.php">权限管理</a></li>
			</ul>
		</li>
	</ul>

</div>
<article>
	<div class="article_title">
    权限管理
	</div>
    <form method="post" >
    <div id="select1">
		<div id="select_title1">
		管理员
		</div>
        
		<select id="select_main1" name="master" multiple="multiple" >
        <?php $g->rmaster();?>
		</select>
	</div>
    <div class="select_img">
    <i class="fa fa-exchange fa-2x"></i><br/>
    <input class="article_button" type="submit" value="提交" name="editu"/>
    </div>
    <div id="select2">
		<div id="select_title2">
		会员
		</div>
		<select id="select_main2" name="user" multiple="multiple" >
        <?php $g->ruser();?>
		</select>
       
        
	</div>
    </form>
         <?php $g->edituser();?>
    <div class="select_img2">
    </div>
    <form method="post" >
    <div id="select3">
		<div id="select_title3">
		会员
		</div>
		<select id="select_main3" name="user2" multiple="multiple" >
         <?php $g->ruser();?>
		</select>
	</div>
    <div class="select_img">
    <i class="fa fa-exchange fa-2x"></i><br/>
    <input class="article_button" type="submit" value="提交" name="editu2"/>
    </div>
    <div id="select4">
		<div id="select_title4">
		编辑
		</div>
		<select id="select_main4" name="editor" multiple="multiple" >
         <?php $g->reditor();?>
		</select>
	</div>
    </form>
     <?php $g->edituser2();?>
</article>

<footer> 
    <address>
<li><?php echo $ss->copyright;?></li>
<li><a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $ss->address;?></a></li>
    </address>
</footer> 
</body>
</html>
