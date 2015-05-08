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
</head> 

<body> 
<?php require_once("header.php");?>
<article>
<div class="main">

<div class="main_left">
<div class="main_left_title">
<?php
if(isset($_GET["content"])){
	$ID = strval($_GET["content"]);
	$g->setSql("select category from l_articles where category = '".$ID."'");
	$f=NULL;
	$g->loadObject($f);
	echo $f->category;
}else{
	echo "全部博文";
	}
?>
</div>
<?php
if(isset($_GET["content"])){
	$ID = strval($_GET["content"]);
	$g->setSql("select title,creation_time from l_articles where category = '".$ID."'order by creation_time desc");
	$g->query();
	$content = $g->loadRow();
	foreach($g->loadRowList() as $content){
	

?>
<a href="article-list.php?title=<?php echo $content[0];?>">
<div class="main_left_list">
<?php echo $content[0];?>
<div class="main_left_list_right">
<?php echo $content[1];?>
</div>

</div>
</a>
<?php 
}
	}
	else{
		$g->setSql("select title,creation_time from l_articles order by creation_time desc");
	$g->query();
	$content = $g->loadRow();
	foreach($g->loadRowList() as $content){
	

		?>
		<a href="article-list.php?title=<?php echo $content[0];?>">
		<div class="main_left_list">
		<?php echo $content[0];?>
		<div class="main_left_list_right">
		<?php echo $content[1];?>
		</div>
		</div>
		</a>
	<?php	
		}
        }

?>
</div>

<div class="photo_right">
<div class="category_main_right">
<div class="category_title">
博文分类
</div>
<div class="category">

<a href="article.php">
<div class="category_list">
<div class="category_list_right">
<?php $g->articles();?>	
</div>
全部博文
</div>
</a>

<?php 
$g->setSql("select content from l_category");
$g->query();
$category = $g->loadRow();
foreach($g->loadRowList() as $category){
$g->setSql("select count(id) from l_articles where category='".$category[0]."'");
$g->query();
$articles = $g->loadRow();
if($articles[0]){
?>
<a href="article.php?content=<?php echo $category[0];?>">
<div class="category_list">
<?php echo ''.$category[0].'';?>
<div class="category_list_right">
<?php echo '('.$articles[0].')';?>	
</div>
</div>
</a>
<?php 
}
}
?>
</div>
</div>
</div>
</div>

</article>
<?php require_once("footer.php");?>
</body> 
</html> 
