<?php
session_start();
include 'templates/class/global.class.php';
$g->auth();
$g->setSql("select * from l_system");
$ss = NULL;
$g->loadObject($ss);
?>
<!DOCTYPE html> 
<head> 
<meta charset=utf-8> 
<title><?php echo $ss->title1;?></title>
<link rel="stylesheet" type="text/css" href="templates/css/home.css"/>
<link rel="stylesheet" type="text/css" href="templates/css/main.css"/>
<link rel="stylesheet" type="text/css" href="templates/css/video/video-js.css" />
<link rel="stylesheet" type="text/css" href="templates/css/font-awesome-4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/layer/layer.js"></script>
<script type="text/javascript" src="templates/js/menu.js"></script>
<script type="text/javascript" src="templates/js/scrollUp.js"></script>
<script src="templates/js/video/video.js"></script>
<script> videojs.options.flash.swf = "templates/video/video-js.swf";</script>
</head> 

<body> 
<?php require_once("header.php");?>
<article>
<div class="photo">
<div class="photo_right">
<div class="user_top">
<div class="portrait_title">
<div class="portrait">
<img src="templates/images/portrait/<?php $g->portrait();?>">
</div><?php $g->menu();?>
</div>
<div class="user_menu">
<li style="float:left"><a href="user.php">个人中心</a></li>
<li style="float:right"><a href="help.php">帮助中心</a></li>
</div>
<div class="user_menu2">
<!--<li style="float:left"><a href="#">私信</a></li>-->
<li style="float:right"><a href="logout.php">退出</a></li>
</div>
<div class="user_menu3">
<li>上一次登陆时间：</li>
<?php $g->usertime();?>
</div>

</div>
<div class="user_down">
<div class="title">
最新留言
</div>
<div class="dynamic">
<?php $g->dynamic();?>
</div>
</div>
</div>

<div class="photo_left">
  <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="710" height="400"
      poster="templates/images/background/2.jpg"
      data-setup="{}">
   <source src="templates/video/1.mp4" type='video/mp4' />
    <p class="vjs-no-js">查看这个视频请启用JavaScript,并考虑升级到一个web浏览器></p>
  </video>
</div>

</div>
<!--<div class="topic">
<div class="topic_right">
我的订阅
</div>
<div class="topic_left">
话题直播
</div>
</div>-->
<div class="main">
<div class="main_right">
广告等其他拓展
</div>
<?php 
			$g->setSql("select * from l_articles order by creation_time desc");
			$g->query();
			if($g->getLines()>0){
				foreach($g->loadRowList() as $a){

	
		
		?>
        <a href="article-list.php?title=<?php echo $a[1];?>">
<div class="main_left">
<div class="main_left_title">

<?php echo ''.$a[1].'&nbsp;&nbsp;';?>
<?php echo ''.$a[2].'&nbsp;&nbsp;';?>
<?php echo ''.$a[5].'&nbsp;&nbsp;';?>

</div>
<div class="main_left_words">
<?php echo ''.$a[4].'';?>
</div>

</div>
</a>
<?php 
			}
		}?>
</article>
<?php require_once("footer.php");?>

</body> 
</html> 
