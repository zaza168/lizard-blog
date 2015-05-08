<?php
session_start();
include 'templates/class/global.class.php';
$g->auth();
$g->setSql("select * from l_system");
$ss = NULL;
$g->loadObject($ss);
$id=$_GET['id'];
$g->setSql("delete from l_users where id='".$id."'");
$g->query();
if($id)
 { 
echo "<script>location.href='user.php';</script>"; 
}
$num_query=mysql_query("select count(id) from l_users");//查询数据库总条数
$pagesize=10;//定义每个页面显示的条数
$users=mysql_fetch_array($num_query);
$count=$users[0];//总条数
$page=empty($_GET['page'])?1:$_GET["page"];//显示当前页
//显示当页面信息页面
$sql="select * from l_users limit ".($page-1)*$pagesize.",".$pagesize ;
$query=mysql_query($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $ss->title2;?></title>
<link rel="stylesheet" type="text/css" href="templates/css/table.css">
<link rel="stylesheet" type="text/css" href="templates/css/main.css">
<link rel="stylesheet" type="text/css" href="templates/css/font-awesome-4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="templates/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="templates/js/top_menu.js"></script>
<script type="text/javascript" src="templates/js/left_menu.js"></script>
<script type="text/javascript" src="templates/js/table.js"></script>

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
				<li class="sub1_color"><a href="user.php">所有用户</a></li>
                <li><a href="edituser.php">权限管理</a></li>
			</ul>
		</li>
	</ul>

</div>
<article>
	<div class="article_title">
    所有用户
	</div>
   <!-- <div class="article_function">
    <button class="article_button" >发 布</button>
    <button class="article_button" >禁 用</button>
    <button class="article_button">删 除</button>
    </div>-->
	<table id="article_table" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th><input type="checkbox" id="all"> </th>
    		<th>编码</th>
    		<th>用户</th>
            <th>注册时间</th>
    		<th>上次登录时间</th>
            <th>权限</th>
            <th>操作</th>
		</tr>
        <?php
		//分页模块
		

		if($users[0]){
		while($users=mysql_fetch_array($query)){
		echo "<tr>";
			echo '<td>
			<input type="checkbox" name="items">
			</td>';
			echo '<td>'.$users[0].'</td>';
			echo '<td>'.$users[1].'</td>';
			echo '<td>'.$users[4].'</td>';
			echo '<td>'.$users[6].'</td>';
			switch ($users[9]){
				case "1":
					echo '<td>博主</td>';break;
				case "2":
					echo '<td>管理员</td>';break;
				case "3":
					echo '<td>编辑</td>';break;
				case "4":
					echo '<td>会员</td>';break;
				default: echo '<td>游客</td>';
				}

			echo '<td>
					<a href="user.php?id='.$users[0].'">删除</a>
				 </td>';
			echo "</tr>";
		}	
			}else{
	echo "<td>暂时没有内容</td>";
	}
		?>
	</table>
<?php 

if($count>10){
$page = new PageClass($count,$pagesize,$page,'?page={page}');//用于动态
echo "".$page -> myde_write()."";
}//显示
?>

</article>

<footer> 
    <address>
<li><?php echo $ss->copyright;?></li>
<li><a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $ss->address;?></a></li>
    </address>
</footer> 
</body>
</html>
