document.getElementById("checkadvice").reset(); 
function checkadvice(){
var input = document.getElementById("input"); 
  if(input.value.length==0){ 
     layer.tips('请输入联系方式','#input'); 
     input.focus(); 
     return false; 
  }
  var code = document.getElementById("code"); 
  if(code.value.length==0){ 
     layer.tips('请输入验证码','#code'); 
     code.focus(); 
     return false; 
  }
   if(code.value.length<4){ 
 layer.tips('验证码共有4位','#code'); 
   code.focus(); 
     return false; 
  } 
    var input2 = document.getElementById("input2"); 
  if(input2.value.length==0){ 
    layer.msg('总得写点什么吧', function(){})
     input2.focus(); 
     return false; 
  }
}