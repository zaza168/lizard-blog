<footer> 
<div class="footer_main">
<div class="footer_block">
<h1>Lizard</h1>
<li><a id="lizard">关于Lizard</a></li>
<li><a  id="disclaimer">免责声明</a></li>
<li><a id="advice">意见建议</a></li>
<!--<li><a href="">举报</a></li>-->
    </div>
    <div class="footer_block">
    <h1>帮助</h1>
<li><a href="#">用户协议</a></li>
<li><a href="#">常见问题</a></li>
<li><a href="help.php">帮助中心</a></li>

    </div>
    <div class="footer_block">
    <h1>友情链接</h1>
	<li><a href="#">暂无</a></li>
    </div>
    <div class="footer_block">
     <h1>更多</h1>
	<li><a href="#">加入我们</a></li>
    <li><a href="user.php">个人中心</a></li>
    </div>
    <img  style="margin-right:20px;" src="templates/images/logo/1.jpg" width="150" alt="网站首页">
     <img src="templates/images/logo/2.jpg" width="150" alt="微信公众账号">
    <address>
<li><?php echo $ss->copyright;?></li>
<li><a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $ss->address;?></a></li>
    </address>
    </div>
</footer> 
<script>
//关于lizard
$('#lizard').on('click', function(){
    layer.open({
        type: 2,
        title: false,
		shadeClose: true,
        area : ['540px' , '400px'],
		offset: '100px',
		content: 'lizard.php',
    });
});

//意见建议
$('#advice').on('click', function(){
   layer.open({
        type: 2,
        title: false,
        shadeClose: true,
        area : ['450px' , '400px'],
		offset: '100px',
		content: 'advice.php',
    });
});
//免责声明
$('#disclaimer').on('click', function(){
    layer.open({
        type: 2,
        title: false,
        shadeClose: true,
		offset: '100px',
        area : ['700px' , '400px'],
		content: 'disclaimer.php',
    });
});
</script>