<!DOCTYPE html> 
<head> 
<meta charset=utf-8> 
<title>Lizard的个人博客</title>
<link href="../../../common/css/footer/about.css" rel="stylesheet" type="text/css" />
<script src="../../../common/js/jquery-1.11.2.min.js"></script>
<script>
$(document).ready(function() {
	$("#content div").hide(); // 最初隐藏所有内容
	$("#tabs li:first").attr("id","current"); // 激活第一个选项卡
	$("#content div:first").fadeIn(); // 显示第一个选项卡的内容
    
    $('#tabs a').click(function(e) {
        e.preventDefault();        
        $("#content div").hide(); //隐藏所有内容
        $("#tabs li").attr("id",""); //重置
        $(this).parent().attr("id","current"); // 激活
        $('#' + $(this).attr('title')).fadeIn(); // 显示当前选项卡的内容
    });
})();
</script>
</head> 
<body> 
<ul id="tabs">
  <li><a title="tab1">李征</a></li>
  <li><a title="tab2">徐海涛</a></li>
  <li><a title="tab3">张超</a></li>
</ul>
<div id="content">
  <div id="tab1">
    李征
  </div>
  <div id="tab2">
    徐海涛
  </div>
  <div id="tab3">
   张超
  </div>
</div>

</body> 
</html> 
