<?php
session_start();
include 'templates/class/global.class.php';
$g->auth();
$g->setSql("select * from l_system");
$ss = NULL;
$g->loadObject($ss);
$id=$_GET['id'];
$g->setSql("delete from l_content where id='".$id."'");
$g->query();
if($id)
 { 
echo "<script>location.href='guest.php';</script>"; 
}
?>
<!DOCTYPE html> 
<head> 
<meta charset=utf-8> 
<title><?php echo $ss->title1;?></title>
<link rel="stylesheet" type="text/css" href="templates/css/main.css"/>
<link rel="stylesheet" type="text/css" href="templates/css/article.css"/>
<link rel="stylesheet" type="text/css" href="templates/js/kindeditor-4.1.10/themes/default/default.css" />
<link rel="stylesheet" type="text/css" href="templates/js/kindeditor-4.1.10/plugins/code/prettify.css" />
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/menu.js"></script>
<script type="text/javascript" src="templates/js/scrollUp.js"></script>
<script charset="utf-8" src="templates/js/kindeditor-4.1.10/kindeditor.js"></script>
<script charset="utf-8" src="templates/js/kindeditor-4.1.10/plugins/code/prettify.js"></script>
<script charset="utf-8" src="templates/js/kindeditor-4.1.10/lang/zh_CN.js"></script>
<script type="text/javascript" src="templates/js/layer/layer.js"></script>

<script language="JavaScript">
function newwin(url) {
  var newwin=window.open(url,"newwin","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=550,height=460");
  newwin.focus();
  return false;
}
</script>
<script>
document.getElementById("news").reset(); 
function checknew(){
   var pass = document.getElementById("editor_id"); 
   if(pass.value.length==0){ 

	layer.msg('总得写点什么吧', function(){
});
      pass.focus(); 
      return false;
    }
}
</script>
<script>

		KindEditor.ready(function(K) {
			var editor = K.create('textarea[name="words"]', {
				cssPath : 'templates/js/kindeditor-4.1.10/plugins/code/prettify.css',
				width : '100%',
				height : '200px;',
				resizeType : 0,
				newlineTag:'br',
				useContextmenu:false,
				pasteType:0,
				items : [
		'emoticons', '|',
		'fontname', 'fontsize',
		'forecolor', 'hilitecolor','bold','italic', 'underline','strikethrough'
						],
				afterChange : function() {
						K('.word_count').html(this.count('text'));
					},
					afterBlur : function() {
						this.sync();
						K.ctrl(document, 13, function() {
						K('form[name=message]')[0].submit();
						});
						K.ctrl(this.edit.doc, 13, function() {
						K('form[name=message]')[0].submit();
						});
						}
				}); 
			prettyPrint();
		});
	</script>
 </head> 
<body> 
<?php require_once("header.php");?>
<?php $g->guest();?>
<article>

<?php
	$g->setSql("select * from l_help where mark = 'guest'");
	$f=NULL;
	$g->loadObject($f);
	$pageid=$f->creation_time;
?>
<div class="photo_right">
<div class="article_main">
<div class="article_main_title">
<?php echo $f->title;?>
</div>
<div class="article_main_function">
<div class="article_main_function_left">
<?php echo $f->username;?>
</div>
<div class="article_main_function_left">
更新于：<?php echo $f->update_time;?>
</div>
</div>
<div class="article_main_content">
<?php echo $f->words;?>
</div>

</div>

		
		

			
			

<?php 
//查询数据库总条数
$num_query=mysql_query("select count(distinct upper_id) from l_content");
$pagesize=5;//定义每个页面显示的条数
$message=mysql_fetch_array($num_query);
$count=$message[0];//总条数
$page=empty($_GET['page'])?1:$_GET["page"];//显示当前页
//显示当页面信息页面
$sql="select * from l_content  group by upper_id limit ".($page-1)*$pagesize.",".$pagesize;
$query=mysql_query($sql);
?>


		

<div class="message">
	<?php	if($message[0]){
		while($message=mysql_fetch_array($query)){ ?>
<div class="message_all">

<div class="message_left">

<div class="message_title">
<img src="templates/images/portrait/<?php $g->portrait();?>">
</div>
<?php	echo ''.$message[1].'<br/>';?>
</div>

<div class="message_right">
<div class="message_right_top">
<?php	echo ''.$message[5].'楼&nbsp&nbsp&nbsp&nbsp';?>
<?php	echo ''.$message[3].'&nbsp&nbsp&nbsp&nbsp';?>
 <a href=newguest.php?id=<?php echo $message[5];?> target=_blank onclick="return newwin(this.href)">回复</a>  
</div>
<div class="message_right_main">
<?php	echo ''.$message[2].'<br/>';?>

</div>

<div class="message_right_down">


<?php
			$g->setSql("select * from l_content where upper_id='".$message[5]."' && create_time >'".$message[3]."'");
			$g->query();
			if($g->getLines()>0){
			$message2 = $g->loadRow();
				foreach($g->loadRowList() as $message2){
				echo ''.$message2[3].'&nbsp&nbsp'; 
				echo ''.$message2[1].'&nbsp:&nbsp';
				echo ''.$message2[2].'&nbsp&nbsp'; 
				
				if($message2[1]==$_SESSION["i"]["username"]){
	
	echo '<a href="guest.php?id='.$message2[0].'">删除</a><br/>';
	}
	
			}
			}
?>

</div>
</div>
            <?php
			} }
			else{
	echo "<li style='text-align:center;font-size:20px;padding-top:10px;'>暂时没有留言</li>";
	}
?>
</div>

<div class="message_page">
<?php

if($count>5){
$page = new PageClass($count,$pagesize,$page,'?page={page}');//用于动态
echo "".$page -> myde_write()."";
}//显示
?>
</div>

<div class="message_edit">

<form id="news" method = "post" onsubmit = "return checknew();" name="newm"/ > 

<textarea id="editor_id"  name="words"><?php echo htmlspecialchars($htmlData); ?> </textarea>
<input class="article_button" type="submit" value="提交" name="newm"/>

</form>

</div>
</div>



</article>
<?php require_once("footer.php");?>
</body> 
</html> 
