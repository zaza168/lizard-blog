<?php
//加载常用类
include 'mysql.class.php';
include 'page.class.php';
include 'code.class.php';
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
	//信息提示窗口3
	function alert3($info,$url,$time=2){
		echo "<script>layer.msg('$info',function(){}) </script>";
		echo '<meta http-equiv="Refresh" content="'.$time.';url='.$url.'"/>';
		exit();
	}
	//信息提示窗口4
		function alert4($info,$url,$time=0){
		echo '<script language="javascript">alert("'.$info.'");</script>'; 
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
				$user["update_time"]=date('Y-m-d H:i:s');
				$user["last_login_ip"]=$_SERVER["REMOTE_ADDR"];
				$this->updateObject("l_master",$user,"username");
				$this->alert2('登陆成功','home.php');
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
							$user["update_time"]=date('Y-m-d H:i:s');
							$user["last_login_ip"]=$_SERVER["REMOTE_ADDR"];
							$this->updateObject("l_users",$user,"username");
							$this->alert2('登陆成功','home.php');
						}else{
							
							$this->alert3('用户名或密码错误，请重试！','index.php');
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
				case "3":
					$this->setSql("select id from l_users where username = '".$username."' and password = '".$pass."'");
					$this->query();
				break;
				case "4":
					$this->setSql("select id from l_users where username = '".$username."' and password = '".$pass."'");
					$this->query();
				break;
			}
			if($this->getLines()<1||$permissions>4){
				$this->alert2('您要找的页面丢掉了','lost.php');
			}
		}	
		else{
			$this->alert2('您要找的页面丢掉了','lost.php');
		}
	}
	
	//清除用户登录数据
	function logout(){
		$this->setSql("select update_time from l_master where username = '".$_SESSION["i"]["username"]."'");
			$this->query();
			if($this->getLines()>0){
				$user = $this->loadRow();
				$a["username"] = $_SESSION["i"]["username"];
				$a["last_login_time"]=$user[0];
				$this->updateObject("l_master",$a,"username");
				}else{
			$this->setSql("select update_time from l_users where username = '".$_SESSION["i"]["username"]."'");
			$this->query();
			if($this->getLines()>0){
				$user = $this->loadRow();
				$a["username"] = $_SESSION["i"]["username"];
				$a["last_login_time"]=$user[0];
				$this->updateObject("l_users",$a,"username");
					}
				}
		unset($_SESSION["i"]);
		echo '<meta http-equiv="Refresh" content=0;url="index.php"/>';
		}

	//密码修改
	function editpassword(){
		$validate="";
		if(isset($_POST["code"])){
		$validate=$_POST["code"];
		if($validate!=$_SESSION["code"]){//判断session值与用户输入的验证码是否一致;
					$this->alert3('验证码错误，请重试！','forget.php');
					
			}else{
				if(isset($_POST["forget"]) and $_POST["forget"]=="修改"){
		$this->setSql("select username from l_users where username = '".trim($_POST["username"])."' and email = '".trim($_POST["email"])."'");
		$this->query();
		if($this->getLines()>0){
			$user = $this->loadRow();		
			$_SESSION["i"]["username"] = trim($_POST["username"]);
			$user["username"] = $_SESSION["i"]["username"];
			$user["password"] = md5(trim($_POST["password2"]));
			$this->updateObject("l_users",$user,"username");
			$this->alert('密码修改成功，请重新登录！','forget.php');
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
						$this->alert3('用户名或邮箱错误，请重试！','forget.php');
						
					}
				}
			}
			}
		} 
		
		}
	//用户注册
	function register(){
		$validate="";
		if(isset($_POST["code"])){
		$validate=$_POST["code"];
		if($validate!=$_SESSION["code"]){
		//判断session值与用户输入的验证码是否一致;
		$this->alert3('验证码错误，请重试！','register.php');
		}else{
			if(isset($_POST["register"]) and $_POST["register"]=="注册"){
			$user = "";
			$user["username"] = trim($_POST["username"]);
			$user["password"] = md5(trim($_POST["password2"]));
			$user["email"] = trim($_POST["email"]);
			$user["reg_time"] =date('Y-m-d H:i:s');
			$user["reg_ip"]=$_SERVER["REMOTE_ADDR"];
		$this->setSql("select id from l_users where username = '".$user["username"]."'");
		$this->query();
		if($this->getLines()>0){
				$this->alert3('用户名已存在！','register.php');
		}else{
			$this->setSql("select id from l_users where email = '".$user["email"]."'");
			$this->query();
			if($this->getLines()>0){
				$this->alert3('邮箱已存在！','register.php');
		}else{
			$this->insertObject("l_users",$user);
			$this->alert('注册成功！','index.php');	
		}
	}
}
}
} 
	
}
	//建议意见
	function newadvice(){
		
		$validate="";
		if(isset($_POST["code"])){
		$validate=$_POST["code"];
		if($validate!=$_SESSION["code"]){
			setcookie("tel",trim($_POST["tel"]), time()+120);
			setcookie("content",trim($_POST["content"]), time()+120);
		$this->alert3('验证码错误，请重试！','advice.php');
		}else{
		if(isset($_POST["advice"]) and $_POST["advice"]=="提交"){
		$newa["tel"] = trim($_POST["tel"]);
		$newa["content"] = trim($_POST["content"]);
		$newa["time"] =date('Y-m-d H:i:s');
		$newa["ip"]=$_SERVER["REMOTE_ADDR"];
		$this->insertObject("l_advice",$newa);
		setcookie ("tel",trim($_POST["tel"]), time()-3600);
		setcookie ("content",trim($_POST["content"]), time()-3600);
		$this->alert('感谢您的建议','advice.php');
		
		
	}
			
		}
		} 

}
	//菜单
	function menu(){
		if(isset($_SESSION["i"])){
			switch ($_SESSION["i"]["permissions"]){
				case "1":
					echo '
						博主<br/>
						'.$_SESSION["i"]["username"].'<br/>
					';
				break;
				case "2":
					echo '
						管理员<br/>
						'.$_SESSION["i"]["username"].'<br/>	
					';
				break;
				case "3":
					echo '
						编辑<br/>
						'.$_SESSION["i"]["username"].'<br/>				
					';
				break;
				case "4":
					echo '
						会员<br/>
						'.$_SESSION["i"]["username"].'<br/>				
					';
				break;
			}
		}
	}
	//首页注册时间显示
	function usertime(){
			$this->setSql("select last_login_time from l_master where username = '".$_SESSION["i"]["username"]."'");
			$this->query();
			if($this->getLines()>0){
			$usertime = $this->loadRow();		
			echo '<li>'.$usertime[0].'</li>';
			}else{
			$this->setSql("select last_login_time from l_users where username = '".$_SESSION["i"]["username"]."'");
			$this->query();
			if($this->getLines()>0){
			$usertime = $this->loadRow();		
			echo '<li>'.$usertime[0].'</li>';
				}
			}
		}
	//个人头像
	function portrait(){
		$this->setSql("select portrait from l_master where username = '".$_SESSION["i"]["username"]."'");
			$this->query();
			if($this->getLines()>0){
			$portrait = $this->loadRow();
			if($portrait[0]){	
			echo ''.$portrait[0].'';
		}else{
			echo '1.jpg';
			}
		}else{
			$this->setSql("select portrait from l_users where username = '".$_SESSION["i"]["username"]."'");
			$this->query();
			if($this->getLines()>0){
			$portrait = $this->loadRow();
			if($portrait[0]){	
			echo ''.$portrait[0].'';
		}else{
			echo '1.jpg';
			}
			}
		}
	}
	//个人最近动态
	function dynamic(){

			$this->setSql("select id,words,create_time from l_content order by create_time desc limit 0,8");//显示内容过长，排版不好看
			$this->query();
			if($this->getLines()>0){
				foreach($this->loadRowList() as $v){
					echo ''.$v[2].'&nbsp;';
					echo ''.$v[1].'<br/>';
					
				}
		}else{
			echo '<a href="guest.php">快来抢沙发！</a>';
		}
		
}

/**************************博文*************************************/
	//全部数目统计
	function articles(){
		$this->setSql("select count(id) from l_articles");
		$this->query();
		if($this->getLines()>0){
			$articles = $this->loadRow();
			echo "($articles[0])";
		}else{
			echo "(0)";;
		}
	}
/************************评论***********************************/
	//发布新评论
	function message(){
	if(isset($_POST["newm"]) and $_POST["newm"]=="提交"){
		if(isset($_GET["upper_id"])){	
			$newm["upper_id"]=strval($_GET["upper_id"]);
			$newm["title"] = strval($_GET["title"]);
			$newm["username"] = $_SESSION["i"]["username"];
			$newm["words"] = trim($_POST["words"]);
			$newm["create_time"] =date('Y-m-d H:i:s');
			$newm["create_ip"]=$_SERVER["REMOTE_ADDR"];
			$this->insertObject("l_message",$newm);
			$this->alert("提交成功！","article-list.php?title=".strval($_GET["title"])."");
		}else{
		$this->setSql("select count(distinct upper_id) from l_message where title='".strval($_GET["title"])."'");
		$this->query();
		$upper_id = $this->loadRow();
		$newm["upper_id"]=$upper_id[0]+1;
		$newm["title"] = strval($_GET["title"]);
		$newm["username"] = $_SESSION["i"]["username"];
		$newm["words"] = trim($_POST["words"]);
		$newm["create_time"] =date('Y-m-d H:i:s');
		$newm["create_ip"]=$_SERVER["REMOTE_ADDR"];
		$this->insertObject("l_message",$newm);
		$this->alert("提交成功！","article-list.php?title=".strval($_GET["title"])."");

		}
	}
}
/************************留言板***********************************/
	function guest(){
	if(isset($_POST["newm"]) and $_POST["newm"]=="提交"){
		$this->setSql("select count(distinct upper_id) from l_content");
		$this->query();
		$upper_id = $this->loadRow();
		$newm["upper_id"]=$upper_id[0]+1;
		$newm["username"] = $_SESSION["i"]["username"];
		$newm["words"] = trim($_POST["words"]);
		$newm["create_time"] =date('Y-m-d H:i:s');
		$newm["create_ip"]=$_SERVER["REMOTE_ADDR"];
		$this->insertObject("l_content",$newm);
		$this->alert("提交成功！","guest.php");

		
	}
}
/*******************************相册*****************************************/
	/*//图片
	function cover(){
		$this->setSql("select id,cover from l_photo");
			$this->query();
			if($this->getLines()>0){
			$portrait = $this->loadRow();
			if($portrait[1]){	
			echo ''.$portrait[1].'';
		}else{
			echo '1.jpg';
			}
		}else{
			echo '1.jpg';
			}
	}
	//名字
		function covername(){
		$this->setSql("select id,title from l_cover");
			$this->query();
			if($this->getLines()>0){
			$portrait = $this->loadRow();
			if($portrait[0]){	
			echo ''.$portrait[1].'';
		}
		}else{
			echo '新建相册';
			}
	}*/
		
	
}

//初始化数据库链接
$g = new globalClass("localhost","root","2696721","lizard_blog","utf8","l");
?>
