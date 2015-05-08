<?php
session_start();
include 'templates/class/global.class.php';
$g->auth();
?>
<!DOCTYPE html> 
<head> 
<meta charset=utf-8> 
<title>Lizard的个人博客</title>
<link rel="stylesheet" type="text/css" href="templates/js/kindeditor-4.1.10/themes/default/default.css" />
<link rel="stylesheet" type="text/css" href="templates/js/kindeditor-4.1.10/plugins/code/prettify.css" />
<script charset="utf-8" src="templates/js/kindeditor-4.1.10/kindeditor.js"></script>
<script charset="utf-8" src="templates/js/kindeditor-4.1.10/plugins/code/prettify.js"></script>
<script charset="utf-8" src="templates/js/kindeditor-4.1.10/lang/zh_CN.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor = K.create('textarea[name="words2"]', {
				cssPath : 'templates/js/kindeditor-4.1.10/plugins/code/prettify.css',
				uploadJson : 'templates/js/kindeditor-4.1.10/php/upload_json.php',
				fileManagerJson : 'templates/js/kindeditor-4.1.10/php/file_manager_json.php',
				allowFileManager : true,
				width : '100%',
				resizeType : 0,
				newlineTag:'br',
				useContextmenu:false,
				items : [
		'multiimage',
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

<article>
<?php
$ID = strval($_GET["id"]);
			$newp["upper_id"]=$ID;
			if(isset($_POST["newp"]) and $_POST["newp"]=="提交"){
			$newp["username"] = $_SESSION["i"]["username"];
			$newp["words"] = trim($_POST["words2"]);
			$newp["create_time"] =date('Y-m-d H:i:s');
			$newp["create_ip"]=$_SERVER["REMOTE_ADDR"];
			$g->insertObject("l_content",$newp);
			$g->alert4('提交成功');
	}
			
?>
<Script language="javascript">
  //打开此脚本的网页将被刷新
  opener.location.reload();
</Script>
<form  method = "post" name="newp"/ > 
<textarea id="editor_id"  name="words2"><?php echo htmlspecialchars($htmlData); ?> </textarea>
<input type="submit" value="提交" name="newp"/>

</form>
</article>

</body> 
</html> 
