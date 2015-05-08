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
<link rel="stylesheet" type="text/css" href="templates/css/editor.css">
<link rel="stylesheet" type="text/css" href="templates/css/main.css">
<link rel="stylesheet" type="text/css" href="templates/js/kindeditor-4.1.10/themes/default/default.css" />
<link rel="stylesheet" type="text/css" href="templates/js/kindeditor-4.1.10/plugins/code/prettify.css" />
<link rel="stylesheet" type="text/css" href="templates/css/font-awesome-4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/top_menu.js"></script>
<script type="text/javascript" src="templates/js/left_menu.js"></script>
<script charset="utf-8" src="templates/js/kindeditor-4.1.10/kindeditor.js"></script>
<script charset="utf-8" src="templates/js/kindeditor-4.1.10/plugins/code/prettify.js"></script>
<script charset="utf-8" src="templates/js/kindeditor-4.1.10/lang/zh_CN.js"></script>
<script type="text/javascript" src="templates/js/layer/layer.js"></script>
<script>
document.getElementById("news").reset(); 
function checknew(){
var username = document.getElementById("title"); 
  if(username.value.length==0){ 
     layer.tips('请输入题目','#title',{
		 tips: [1, '#F90'] 
		 }); 
     username.focus(); 
     return false; 
  } 
   var pass = document.getElementById("category"); 
   if(pass.value.length==0){ 
   layer.tips('请选择分类','#category',{
		 tips: [1, '#F90'] 
		 }); 
      pass.focus(); 
      return false; 
    } 
	   var pass = document.getElementById("username"); 
   if(pass.value.length==0){ 
      layer.tips('请选择作者','#username',{
		 tips: [1, '#F90'] 
		 });   
      pass.focus(); 
      return false; 
    } 
	   var pass = document.getElementById("state"); 
   if(pass.value.length==0){ 
      layer.tips('请选择状态','#state',{
		 tips: [1, '#F90'] 
		 });   
      pass.focus(); 
      return false; 
    }
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
			var editor = K.create('textarea[name="article"]', {
				cssPath : 'templates/js/kindeditor-4.1.10/plugins/code/prettify.css',
				uploadJson : 'templates/js/kindeditor-4.1.10/php/upload_json.php',
				fileManagerJson : 'templates/js/kindeditor-4.1.10/php/file_manager_json.php',
				allowFileManager : true,
				width : '100%',
				height : '400px',
				resizeType : 0,
				newlineTag:'br',
				useContextmenu:false,
				items : [
		'selectall','cut', 'copy', 'paste','plainpaste', 'wordpaste','|','image', 'multiimage',
		'flash','media', 'insertfile', 'table','emoticons', 'baidumap', 'link', 'unlink','|',
		'code','removeformat','clearhtml','fullscreen',  '/','undo', 'redo','|','fontname', 'fontsize',
		'forecolor', 'hilitecolor','bold','italic', 'underline','strikethrough','|','justifyleft', 
		'justifycenter', 'justifyright','justifyfull','insertorderedlist','insertunorderedlist',
		'subscript','superscript','|', 'preview'
						],
				afterChange : function() {
						K('.word_count').html(this.count('text'));
					},
					afterBlur : function() {
						this.sync();
						K.ctrl(document, 13, function() {
						K('form[name=edita]')[0].submit();
						});
						K.ctrl(this.edit.doc, 13, function() {
						K('form[name=edita]')[0].submit();
						});
						}
				}); 
			prettyPrint();
		});
	</script>
</head>

<body>
<header>
<span id="logo">
<img src="templates/images/logo/logo.png" width="130" height="30" /></div>
</span>
	<nav>
      <li><a href="admin.php"><i class="fa fa-home fa-fw"></i> 首页</a></li>
      <li class="color"><a href="article.php"><i class="fa fa-file-text-o fa-fw "></i> 内容</a></li>
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
<div class="left_menu">
<ul class="left_menu_a">
	<ul>
		<li>
			<div class="left_menu_title1">
            <i class="fa fa-files-o fa-fw"></i> 博文管理<i class="fa fa-chevron-up fa-fw"></i></div>
			<ul class="left_menu_sub1">
				<li><a href="article.php">所有博文</a></li>
				<li class="sub1_color"><a href="newarticle.php">编辑博文</a></li>
			</ul>
		</li>
	</ul>
    <ul>
		<li>
			<div class="left_menu_title">
            <i class="fa fa-comments-o fa-fw"></i> 微博管理<i class="fa fa-chevron-down fa-fw"></i></div>
			<ul class="left_menu_sub">
				<li><a href="talk.php">所有微博</a></li>
                <li><a href="newtalk.php">编辑微博</a></li>
			</ul>
		</li>
	</ul>
    <ul>
		<li>
			<div class="left_menu_title">
            <i class="fa fa-comment fa-fw"></i> 留言管理<i class="fa fa-chevron-down fa-fw"></i></div>
			<ul class="left_menu_sub">
				<li><a href="content.php">所有留言</a></li>
				<li><a href="newguest.php">作者寄语</a></li>
			</ul>
		</li>
	</ul>
    
    <ul>
		<li>
			<div class="left_menu_title">
            <i class="fa fa-list-ul fa-fw"></i> 分类管理<i class="fa fa-chevron-down fa-fw"></i></div>
			<ul class="left_menu_sub">
				<li><a href="category.php">所有分类</a></li>
			</ul>
		</li>
	</ul>

</div>
<?php $g->editarticle();?>
<article>
<?php
if(isset($_GET["id"])){
	$ID = strval($_GET["id"]);
	$g->setSql("select * from l_articles where id = '".$ID."'");
	$f = NULL;
	$g->loadObject($f);
}
?>

	<div class="article_title">
    编辑博文
	</div>
    <div class="article_function">
    <form id="news" method = "post" onsubmit = "return checknew();" name="edita"/ > 
	题目：<input type="text" class="article_input" id="title" name="title" value="<?php echo $f->title;?>" placeholder="未命名" >
    分类：
		<select class="article_select" name="category" id="category">
  			<option value="<?php echo $f->category;?>"><?php echo $f->category;?>（默认）</option>
			<?php $g->category();?>
		</select>
    状态：
		<select class="article_select1" name="state" id="state">
  			
			<?php
			if($f->state){
				echo '<option value="1">';
				echo "正常";
				echo "</option>";
				echo '<option value="0">';
				echo "关闭";
				echo "</option>";
                }else{
					echo '<option value="0">';
					echo "关闭";
					echo "</option>";
					echo '<option value="1">';
					echo "正常";
					echo "</option>";
					}
			?>
		</select>

    <input class="article_button" type="submit" value="提交" name="edita"/>
    </div>
    <div class="article_main">
    正文：（字数统计：<span class="word_count">0</span>）
    <textarea id="editor_id" name="article"><?php echo $f->content;?></textarea>
    
 </form>
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
