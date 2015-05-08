
<footer> 
<div id="footer_main">
<div class="footer_box" id="lizard">
<a>关于Lizard</a>
</div>
<div class="footer_box" id="advice">
<a>意见建议</a>
</div>
<div class="footer_box" id="disclaimer">
<a>免责声明</a>
</div>
<div class="footer_box">
<a onClick="parent.location='mailto:zaza168@yeah.net?subject=Lizard个人博客'">联系我们</a>
</div>
</div>
    <address>
<li><?php echo $ss->copyright;?></li>
<li><a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $ss->address;?></a></li>
    </address>
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