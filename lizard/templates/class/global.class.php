<?php
//加载常用类
include 'mysql.class.php';
include 'page.class.php';
class globalClass extends mysql{
	function globalClass($host,$user,$pass,$db,$charset,$pre){
		//链接数据库
		$this->mysql($host,$user,$pass,$db,$charset,$pre);
	}

	//信息提示窗口
	function alert($info,$url,$time=2){
		echo "<script>layer.msg('$info') </script>";
		echo '<meta http-equiv="Refresh" content="'.$time.';url='.$url.'"/>';
		exit();
	}
	//信息提示窗口2
	function alert2($info,$url,$time=0){
		echo '<meta http-equiv="Refresh" content="'.$time.';url='.$url.'"/>';
		exit();
	}

	//用户登录
	function login(){
		if(isset($_POST["login"]) and $_POST["login"]=="登陆"){
			$this->setSql("select id,permissions from l_master where username = '".trim($_POST["username"])."' and password = '".md5(trim($_POST["password"]))."'");
			$this->query();
			if($this->getLines()>0){
				$user = $this->loadRow();
				$_SESSION["i"]["id"] = $user[0];
				$_SESSION["i"]["permissions"] = $user[1];
				$_SESSION["i"]["username"] = trim($_POST["username"]);
				$_SESSION["i"]["password"] = md5(trim($_POST["password"]));
				$user["username"] = $_SESSION["i"]["username"];
				$user["last_login_time"]=date('Y-m-d H:i:s');
				$user["last_login_ip"]=$_SERVER["REMOTE_ADDR"];
				$this->updateObject("l_master",$user,"username");
				echo '<meta http-equiv="Refresh" content=0;url="admin.php"/>';
				}else{
						$this->setSql("select id,permissions from l_users where username = '".trim($_POST["username"])."' and password = '".md5(trim($_POST["password"]))."'");
						$this->query();
						if($this->getLines()>0){
							$user = $this->loadRow();
							$_SESSION["i"]["id"] = $user[0];
							$_SESSION["i"]["permissions"] = $user[1];
							$_SESSION["i"]["username"] = trim($_POST["username"]);
							$_SESSION["i"]["password"] = md5(trim($_POST["password"]));
							$user["username"] = $_SESSION["i"]["username"];
							$user["last_login_time"]=date('Y-m-d H:i:s');
							$user["last_login_ip"]=$_SERVER["REMOTE_ADDR"];
							$this->updateObject("l_users",$user,"username");
							echo '<meta http-equiv="Refresh" content=0;url="admin.php"/>';
						}else{
							echo "<script>layer.msg('用户名或密码错误，请重试！', function(){}); </script>";
						}
				}
		}
		
	}
	//用户认证
	function auth(){
		$username = $_SESSION["i"]["username"];
		$pass = $_SESSION["i"]["password"];
		$permissions=$_SESSION["i"]["permissions"];
		if(isset($_SESSION["i"])){
			switch ($permissions){
				case "1":
					$this->setSql("select id from l_master where username = '".$username."' and password = '".$pass."'");
					$this->query();
				break;
				case "2":
					$this->setSql("select id from l_users where username = '".$username."' and password = '".$pass."'");
					$this->query();
				break;
			}
			if($this->getLines()<1||$permissions>2){
				$this->alert2('您要找的页面丢掉了','lost.php');
			}
		}	
		else{
			$this->alert2('您要找的页面丢掉了','lost.php');
		}
	}
	
	//清除用户登录数据
	function logout(){
		unset($_SESSION["i"]);
		echo '<meta http-equiv="Refresh" content=0;url="index.php"/>';
		}
		
	//密码修改
	function editpassword(){
		if(isset($_POST["forgot"]) and $_POST["forgot"]=="提交"){
		$this->setSql("select username from l_users where username = '".trim($_POST["username"])."' and email = '".trim($_POST["email"])."'");
		$this->query();
		if($this->getLines()>0){
			$user = $this->loadRow();		
			$_SESSION["i"]["username"] = trim($_POST["username"]);
			$user["username"] = $_SESSION["i"]["username"];
			$user["password"] = md5(trim($_POST["password2"]));
			$this->updateObject("l_users",$user,"username");
			$this->alert('密码修改成功，请重新登录！','index.php');
			}else{
				$this->setSql("select username from l_master where username = '".trim($_POST["username"])."' and email = '".trim($_POST["email"])."'");
				$this->query();
				if($this->getLines()>0){
					$master = $this->loadRow();		
					$_SESSION["i"]["username"] = trim($_POST["username"]);
					$master["username"] = $_SESSION["i"]["username"];
					$master["password"] = md5(trim($_POST["password2"]));
					$this->updateObject("l_master",$master,"username");
					$this->alert('密码修改成功，请重新登录！','index.php');
					}else{
						echo "<script>layer.msg('用户名或邮箱错误，请重试！', function(){}); </script>";
					}
				}
			}
		}
				
	//菜单
	function menu(){
		if(isset($_SESSION["i"])){
				echo ''.$_SESSION["i"]["username"].'';
				}
			}
	//users统计信息
	function users(){
		$this->setSql("select count(id) from l_users where permissions>2");
		$this->query();
		if($this->getLines()>=1){
			$user = $this->loadRow();
			echo "$user[0]";
		}else{
			echo "0";;
		}
	}
	//master统计信息
	function master(){
		$this->setSql("select count(id) from l_users where permissions=2");
		$this->query();
		if($this->getLines()>=1){
			$user = $this->loadRow();
			echo "$user[0]";
		}else{
			echo "0";;
		}
	}
	//articles统计信息
	function articles(){
		$this->setSql("select count(id) from l_articles");
		$this->query();
		if($this->getLines()>=1){
			$user = $this->loadRow();
			echo "$user[0]";
		}else{
			echo "0";;
		}
	}
	//category统计信息
	function categorys(){
		$this->setSql("select count(id) from l_category");
		$this->query();
		if($this->getLines()>=1){
			$user = $this->loadRow();
			echo "$user[0]";
		}else{
			echo "0";;
		}
	}
	//content统计信息
	function content(){
		$this->setSql("select count(id) from l_content");
		$this->query();
		if($this->getLines()>=1){
			$user = $this->loadRow();
			echo "$user[0]";
		}else{
			echo "0";;
		}
	}
	//talk统计信息
	function talk(){
		$this->setSql("select count(id) from l_talk");
		$this->query();
		if($this->getLines()>=1){
			$user = $this->loadRow();
			echo "$user[0]";
		}else{
			echo "0";;
		}
	}
/*******************博文****************************/
	function category(){
			$this->setSql("select * from l_category order by id asc");
			$this->query();
			if($this->getLines()>0){
			$category = $this->loadRow();
			foreach($this->loadRowList() as $category){
			echo '<option value='.$category[2].'>';
			echo ''.$category[2].'';
			echo '</option>';
			}
			}else{
			echo "暂无分类";
			}
		}
	//发布新文章
	function newarticle(){
	if(isset($_POST["newa"]) and $_POST["newa"]=="提交"){
		$htmlData = '';
		if (!empty($_POST['article'])) {
			if (get_magic_quotes_gpc()) {
				$htmlData = stripslashes($_POST['article']);
			} else {
				$htmlData = $_POST['article'];
			}
		}
		$newa["title"] = trim($_POST["title"]);
		$newa["category"] = trim($_POST["category"]);
		$newa["username"] = $_SESSION["i"]["username"];
		$newa["content"] = trim($_POST["article"]);
		$newa["state"] =trim($_POST["state"]);
		$newa["creation_time"] =date('Y-m-d H:i:s');
		$newa["last_time"] =date('Y-m-d H:i:s');
		$newa["last_ip"]=$_SERVER["REMOTE_ADDR"];
		$this->insertObject("l_articles",$newa);
		$this->alert('提交成功！','article.php');	
		
	}
}
	//修改文章
	function editarticle(){
	if(isset($_POST["edita"]) and $_POST["edita"]=="提交"){
		$edita["id"] = strval($_GET["id"]);
		$edita["title"] = trim($_POST["title"]);
		$edita["category"] = trim($_POST["category"]);
		$edita["username"] = $_SESSION["i"]["username"];
		$edita["content"] = trim($_POST["article"]);
		$edita["state"] =trim($_POST["state"]);
		$edita["last_time"] =date('Y-m-d H:i:s');
		$edita["last_ip"]=$_SERVER["REMOTE_ADDR"];
		$this->updateObject("l_articles",$edita,"id");
		$this->alert('提交成功！','article.php');	
		
	}
}
/******************微博****************************/
	//发布新微博
	function newtalk(){
	if(isset($_POST["newt"]) and $_POST["newt"]=="提交"){
		$newt["username"] = $_SESSION["i"]["username"];
		$newt["words"] = trim($_POST["talk"]);
		$newt["create_time"] =date('Y-m-d H:i:s');
		$newt["create_ip"]=$_SERVER["REMOTE_ADDR"];
		$newt["last_time"] =date('Y-m-d H:i:s');
		$newt["last_ip"]=$_SERVER["REMOTE_ADDR"];
		$this->insertObject("l_talk",$newt);
		$this->alert('提交成功！','talk.php');	
		
	}
}
	//修改微博
	function edittalk(){
	if(isset($_POST["editt"]) and $_POST["editt"]=="提交"){
		$editt["id"] = strval($_GET["id"]);
		$editt["words"] = trim($_POST["talk"]);
		$editt["last_time"] =date('Y-m-d H:i:s');
		$editt["last_ip"]=$_SERVER["REMOTE_ADDR"];
		$this->updateObject("l_talk",$editt,"id");
		$this->alert('提交成功！','talk.php');	
		
	}
}
/********************分类****************************/

	//新分类
	function newcategory(){
	if(isset($_POST["newc"]) and $_POST["newc"]=="增加"){
		$newc["username"]=$_SESSION["i"]["username"];
		$newc["content"] = trim($_POST["category"]);
		$newc["creation_time"] =date('Y-m-d H:i:s');
		$this->insertObject("l_category",$newc);
		$this->alert2('提交成功！','category.php');	
		
	}
}
/********************留言板****************************/
	//作者寄语
	function newguest(){
	if(isset($_POST["edita"]) and $_POST["edita"]=="提交"){
		$edita["mark"] = guest;
		$edita["title"] = trim($_POST["title"]);
		$edita["username"] = $_SESSION["i"]["username"];
		$edita["words"] = trim($_POST["article"]);
		$edita["update_time"] =date('Y-m-d H:i:s');
		$edita["update_ip"]=$_SERVER["REMOTE_ADDR"];
		$this->updateObject("l_help",$edita,"mark");
		$this->alert('提交成功！','newguest.php');
		
	}
}
/********************用户****************************/
	//用户
	function newuser(){
	if(isset($_POST["newc"]) and $_POST["newc"]=="增加"){
		$newc["username"]=$_SESSION["i"]["username"];
		$newc["content"] = trim($_POST["category"]);
		$newc["creation_time"] =date('Y-m-d H:i:s');
		$this->insertObject("l_category",$newc);
		$this->alert2('提交成功！','category.php');	
		
	}
}
	//读取
	function rmaster(){
			$this->setSql("select username,permissions from l_users where permissions=2");
			$this->query();
			if($this->getLines()>0){
			$rmaster = $this->loadRow();
			foreach($this->loadRowList() as $rmaster){
			echo '<option value='.$rmaster[0].'>';
			echo ''.$rmaster[0].'';
			echo '</option>';
			}
			}else{
			echo "暂无作者";
			}
		}
	function ruser(){
			$this->setSql("select username,permissions from l_users where permissions>3");
			$this->query();
			if($this->getLines()>0){
			$ruser = $this->loadRow();
			foreach($this->loadRowList() as $ruser){
			echo '<option value='.$ruser[0].'>';
			echo ''.$ruser[0].'';
			echo '</option>';
			}
			}else{
			echo "暂无作者";
			}
		}
	function reditor(){
			$this->setSql("select username,permissions from l_users where permissions=3");
			$this->query();
			if($this->getLines()>0){
			$reditor = $this->loadRow();
			foreach($this->loadRowList() as $reditor){
			echo '<option value='.$reditor[0].'>';
			echo ''.$reditor[0].'';
			echo '</option>';
			}
			}
		}
	//更新
	function edituser(){
	if(isset($_POST["editu"]) and $_POST["editu"]=="提交"){
				if(trim($_POST["master"])){
				$editu["username"] = trim($_POST["master"]);
				$editu["permissions"] = 2;
				$this->updateObject("l_users",$editu,"username");
				$this->alert2('提交成功！','edituser.php');
				}else{
				$editu["username"] = trim($_POST["user"]);
				$editu["permissions"] = 4;
				$this->updateObject("l_users",$editu,"username");
				$this->alert2('提交成功！','edituser.php');
				}
		}
	}
	//更新2
	function edituser2(){
	if(isset($_POST["editu2"]) and $_POST["editu2"]=="提交"){
				if(trim($_POST["editor"])){
				$editu["username"] = trim($_POST["editor"]);
				$editu["permissions"] = 3;
				$this->updateObject("l_users",$editu,"username");
				$this->alert2('提交成功！','edituser.php');
				}else{
				$editu["username"] = trim($_POST["user2"]);
				$editu["permissions"] = 4;
				$this->updateObject("l_users",$editu,"username");
				$this->alert2('提交成功！','edituser.php');
				}
		}
	}
/**************************系统****************************************/
//基本管理
	function editsystem(){
	if(isset($_POST["system"]) and $_POST["system"]=="提交"){
		$system["id"] = strval($_GET["id"]);
		$system["title1"] = trim($_POST["title1"]);
		$system["title2"] = trim($_POST["title2"]);
		$system["address"] = trim($_POST["address"]);
		$system["username"] = $_SESSION["i"]["username"];
		$system["copyright"] = trim($_POST["copyright"]);
		$system["last_time"] =date('Y-m-d H:i:s');
		$system["last_ip"]=$_SERVER["REMOTE_ADDR"];
		$this->updateObject("l_system",$system,"id");
		$this->alert('提交成功！','system.php?id=1');	
		
	}
	}
	
}

//初始化数据库链接
$g = new globalClass("localhost","root","2696721","lizard_blog","utf8","l");
?>
