<?php
session_start();
include 'templates/class/global.class.php';
$g->auth();
$g->setSql("select * from l_system");
$ss = NULL;
$g->loadObject($ss);
$uptypes=array('image/jpg',  //上传文件类型列表
 'image/jpeg',
 'image/png',
 'image/pjpeg',
 'image/gif',
 'image/bmp',
 'application/x-shockwave-flash',
 'image/x-png',
 'application/msword',
 'audio/x-ms-wma',
 'audio/mp3',
 'application/vnd.rn-realmedia',
 'application/x-zip-compressed',
 'application/octet-stream');

$max_file_size=20000000;   //上传文件大小限制, 单位BYTE
$path_parts=pathinfo($_SERVER['PHP_SELF']); //取得当前路径
$destination_folder="templates/images/photo/"; //上传文件路径
$watermark=1;   //是否附加水印(1为加水印,其他为不加水印);
$watertype=1;   //水印类型(1为文字,2为图片)
$waterposition=1;   //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);
$waterstring="lizard168.com"; //水印字符串
$waterimg="LOGO.png";  //水印图片
$imgpreview=1;   //是否生成预览图(1为生成,其他为不生成);
$imgpreviewsize=1/2;  //缩略图比例

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
<script>
layer.config({
    extend: 'extend/layer.ext.js',
}); 
</script>
</head> 
<body> 
<?php require_once("header.php");?>

<article>
<div class="photo_right">

<div class="photo">
<?php 
		if(isset($_SESSION["i"])){
			switch ($_SESSION["i"]["permissions"]){
				case "1":
					echo ' 
							<div class="photo_function">
							<div class="photo_function_left">
							<form enctype="multipart/form-data" method="post" name="upform">
							<input name=upfile type=file style="background-color:#ffffff;">
							<input type="submit" value="上传">
							</form>
							</div>
							</div>
						';
				break;
			}
		}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (!is_uploaded_file($_FILES["upfile"][tmp_name]))
//是否存在文件
{
echo "<font color='red'>文件不存在！</font>";
exit;
}

 $file = $_FILES["upfile"];
 var_dump ();
 if($max_file_size < $file["size"])
 //检查文件大小
 {
 echo "<font color='red'>文件太大！</font>";
 exit;
  }

if(!in_array($file["type"], $uptypes))
//检查文件类型
{
 echo "<font color='red'>不能上传此类型文件！</font>";
 exit;
}

if(!file_exists($destination_folder))
mkdir($destination_folder);

$filename=$file["tmp_name"];
$image_size = getimagesize($filename);
$pinfo=pathinfo($file["name"]);
$ftype=$pinfo[extension];
$destination = $destination_folder.time().".".$ftype;
if (file_exists($destination) && $overwrite != true)
{
     echo "<font color='red'>同名文件已经存在了！</a>";
     exit;
  }

 if(!move_uploaded_file ($filename, $destination))
 {
   echo "<font color='red'>移动文件出错！</a>";
     exit;
  }

$pinfo=pathinfo($destination);
$fname=$pinfo[basename];
if($watermark==1)
{
$iinfo=getimagesize($destination,$iinfo);
$nimage=imagecreatetruecolor($image_size[0],$image_size[1]);
$white=imagecolorallocate($nimage,255,255,255);
$black=imagecolorallocate($nimage,0,0,0);
$red=imagecolorallocate($nimage,255,0,0);
imagefill($nimage,0,0,$white);
switch ($iinfo[2])
{
 case 1:
 $simage =imagecreatefromgif($destination);
 break;
 case 2:
 $simage =imagecreatefromjpeg($destination);
 break;
 case 3:
 $simage =imagecreatefrompng($destination);
 break;
 case 6:
 $simage =imagecreatefromwbmp($destination);
 break;
 default:
 die("<font color='red'>不能上传此类型文件！</a>");
 exit;
}

imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);
imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);

switch($watertype)
{
 case 1:  //加水印字符串
 imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);
 break;
 case 2:  //加水印图片
 $simage1 =imagecreatefromgif("LOGO.png");
 imagecopy($nimage,$simage1,0,0,0,0,85,15);
 imagedestroy($simage1);
 break;
}

switch ($iinfo[2])
{
 case 1:
 //imagegif($nimage, $destination);
 imagejpeg($nimage, $destination);
 break;
 case 2:
 imagejpeg($nimage, $destination);
 break;
 case 3:
 imagepng($nimage, $destination);
 break;
 case 6:
 imagewbmp($nimage, $destination);
 //imagejpeg($nimage, $destination);
 break;
}

//覆盖原上传文件
imagedestroy($nimage);
imagedestroy($simage);
}

if($imgpreview)
{
		$newp["username"] = $_SESSION["i"]["username"];
		$newp["cover"] = $fname;
		$newp["creation_time"] =date('Y-m-d H:i:s');
		$newp["creation_ip"]=$_SERVER["REMOTE_ADDR"];
		$g->insertObject("l_photo",$newp);
		$g->alert('提交成功','photo.php');
}
}
?>
<?php
			$g->setSql("select id,cover from l_photo");
			$g->query();
			if($g->getLines()>0){
			$photo = $g->loadRow();
				foreach($g->loadRowList() as $photo){

?>
<div class="photo_main">
<div class="photo_main_up" >
<img layer-src="templates/images/photo/<?php echo ''.$photo[1].'';?>" src="templates/images/photo/<?php echo ''.$photo[1].'';?>" width=500>

</div>
<?php echo ''.$photo[1].'';?>
</div>
<?php 				
			}
			}?>
<script>
layer.ready(function(){ 
    layer.photos({
        photos: '.photo_main_up',
    });
});     
</script>
</div>
</div>

</article>

<?php require_once("footer.php");?>
</body> 
</html> 
