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
<link rel="stylesheet" type="text/css" href="templates/css/admin.css">
<link rel="stylesheet" type="text/css" href="templates/css/font-awesome-4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/top_menu.js"></script>
</head>

<body>
<header>
<span id="logo">
<img src="templates/images/logo/logo.png" width="130" height="30" /></div>
</span>
	<nav>
      <li class="color"><a href="admin.php"><i class="fa fa-home fa-fw"></i> 首页</a></li>
      <li><a href="article.php"><i class="fa fa-file-text-o fa-fw "></i> 内容</a></li>
       <li><a href="user.php"><i class="fa fa-user fa-fw"></i> 用户</a></li>
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

<article>
<div id="article_left">
    <div class="square_top">
    	<div class="square">
            <div class="square_right"><?php $g->users();?>
        	</div>
        	<div class="square_left">
        	<i class="fa fa-users fa-fw fa-3x"></i> 用户
        	</div>
    	</div>
        <div class="square">
            <div class="square_right"><?php $g->master();?>
        	</div>
        	<div class="square_left">
        	<i class="fa fa-user fa-fw fa-3x"></i> 管理员
        	</div>
    	</div>

    	<!--<div class="square">
            <div class="square_right">0
        	</div>
        	<div class="square_left">
        	<i class="fa fa-line-chart fa-fw fa-3x"></i> 访问量
        	</div>
    	</div>-->
	</div>
    <div class="square_top">
    	<div class="square">
            <div class="square_right"><?php $g->articles();?>
        	</div>
        	<div class="square_left">
        	<i class="fa fa-files-o  fa-fw fa-3x"></i> 博文
        	</div>
    	</div>
    	<div class="square">
            <div class="square_right"><?php $g->categorys();?>
        	</div>
        	<div class="square_left">
        	<i class="fa fa-tag  fa-fw fa-3x"></i> 分类
        	</div>
    	</div>
	</div>
	<div class="square_top">
    	<div class="square">
            <div class="square_right"><?php $g->talk();?>
        	</div>
        	<div class="square_left">
        	<i class="fa fa-comments-o fa-fw fa-3x"></i> 随心说
        	</div>
    	</div>
    	<div class="square">
            <div class="square_right"><?php $g->content();?>
        	</div>
        	<div class="square_left">
        	<i class="fa fa-comment fa-fw fa-3x"></i> 留言
        	</div>
    	</div>
	</div>
</div>

<div id="article_right">
	<div id="article_right_title">
		<i class="fa fa-database fa-fw"></i> 服务器信息
	</div>
    <div id="article_right_main">
    <div id="article_right_main_left">
		博主邮箱
	</div>
		zaza168@yeah.net
    </div>
    <div id="article_right_main">
    <div id="article_right_main_left">
		登陆IP
	</div>
		<?php echo $_SERVER["REMOTE_ADDR"];?>
    </div>
	<div id="article_right_main">
    <div id="article_right_main_left">
		PHP版本
	</div>
		<?php echo PHP_VERSION ?>
    </div>
    <div id="article_right_main">
    <div id="article_right_main_left">
		MySQL版本
	</div>
		<?php
			mysql_connect("127.0.0.1","root","2696721");
			echo mysql_get_server_info();
		?>
    </div>
    <div id="article_right_main">
    <div id="article_right_main_left">
		Web服务器
	</div>
		<?php echo $_SERVER["SERVER_SOFTWARE"];?>
    </div>
    <div id="article_right_main">
    <div id="article_right_main_left">
		最大上传限制
	</div>
		<?php
	echo ini_get("file_uploads") ? ini_get("upload_max_filesize"):
	'<span style="color:red">Disabled</span>';
		?>
    </div>
    <div id="article_right_main">
    <div id="article_right_main_left">
		服务器时间
	</div>
		<?php echo date("Y-m-d H:i:s");?>
    </div>
    <div id="article_right_main">
    <div id="article_right_main_left">
		远程文件获取
	</div>
		<?php echo ini_get("allow_url_fopen") ? '<span style="color:green">Supported</span>'
		:'<span style="color:green">Not supported</span>';?>
    </div>
</div>
</article>

<footer> 
    <address>
<li><?php echo $ss->copyright;?></li>
<li><a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $ss->address;?></a></li>
    </address>
</footer> 
</body>
</html>
