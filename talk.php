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
<link rel="stylesheet" type="text/css" href="templates/css/main.css"/>
<link rel="stylesheet" type="text/css" href="templates/css/article.css"/>
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/menu.js"></script>
<script type="text/javascript" src="templates/js/scrollUp.js"></script>
<script type="text/javascript" src="templates/js/layer/layer.js"></script>
</head> 
<body> 
<?php require_once("header.php");?>
<?php 
//查询数据库总条数
$num_query=mysql_query("select count(id) from l_talk");
$pagesize=10;//定义每个页面显示的条数
$talk=mysql_fetch_array($num_query);
$count=$talk[0];//总条数
$page=empty($_GET['page'])?1:$_GET["page"];//显示当前页
//显示当页面信息页面
$sql="select * from l_talk order by create_time desc limit ".($page-1)*$pagesize.",".$pagesize;
$query=mysql_query($sql);?>
<article>

<div class="photo_right">

<?php
if($talk[0]){
		while($talk=mysql_fetch_array($query)){ ?>
<div class="talk">
<div class="talk_function">
<div class="talk_function_left">
<div class="portrait">
<img src="templates/images/portrait/<?php $g->portrait();?>" width="20px">
</div>
<?php	echo '&nbsp;'.$talk[6].'<br/>';?>
</div>
</div>

<div class="talk_main">
<?php	echo ''.$talk[1].'<br/>';?>
</div>

<div class="talk_function">
<div class="talk_function_left">
<?php	echo ''.$talk[2].'<br/>';?>
</div>

</div>

</div>
            <?php
		}}
					else{
	echo "<li style='text-align:center;font-size:20px;padding-top:10px;'>暂时没有评论</li>";
	}

?>
<div class="message_page">
<?php

if($count>10){
$page = new PageClass($count,$pagesize,$page,'talk.php?page={page}');//用于动态
echo "".$page -> myde_write()."";
}//显示
?>
</div>
</div>

</article>

<?php require_once("footer.php");?>
</body> 
</html> 
