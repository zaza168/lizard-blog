
$(function(){
	$('#password').passwordStrength();
});
//勾选注册
$(function(){
    var regBtn = $("#register");
    $("#checkbox").change(function(){
        var that = $(this);
        that.prop("checked",that.prop("checked"));
        if(that.prop("checked")){
            regBtn.prop("disabled",false)
        }else{
            regBtn.prop("disabled",true)
        }
    });
});


 document.getElementById("checkregister").reset(); 
  function checkregister(){ 
  //验证用户名 
  var username = document.getElementById("username"); 
  if(username.value.length==0){ 
    layer.tips('账户不能为空','#username');  
     username.focus(); 
     return false; 
  } else
  if(username.value.length<6){ 
  layer.tips('账户不能小于6位','#username');   
   username.value = ""; 
   username.focus(); 
     return false; 
  } 
   //验证密码，确认密码 
   var pass = document.getElementById("password"); 
   var qrpass = document.getElementById("password2"); 
   if(pass.value.length==0){ 
      layer.tips('密码不能为空','#password');  
      pass.focus(); 
      return false; 
    } 
    if(pass.value.length<6){ 
          layer.tips('密码不能小于6位','#password');
         pass.value = ""; 
         pass.focus(); 
         return false; 
    }else if(pass.value!=qrpass.value){ 
      layer.tips('密码不一致','#password2');
     qrpass.value = ""; 
     qrpass.focus(); 
      return false; 
    } 
    //验证邮箱   
    var objName = document.getElementById("email"); 
    var pattern = /^[a-zA-Z0-9]{1,}@[a-zA-Z0-9]{1,10}[.](com|cn|net)$/;   
    if(objName.value==0){ 
       layer.tips('请输入您的邮箱','#email');
       objName.focus(); 
       return false; 
    } 
    if (!pattern.test(objName.value)) {   
           layer.tips('邮箱格式不正确','#email');
           objName.focus(); 
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
  }

/*登录验证*/
document.getElementById("checklogin").reset(); 
function checklogin(){
var username = document.getElementById("username"); 
  if(username.value.length==0){ 
     layer.tips('请输入账号','#username'); 
     username.focus(); 
     return false; 
  } else
  if(username.value.length<6){ 
   layer.tips('请输入正确的账号','#username');  
   username.focus(); 
     return false; 
  } 
   //验证密码 
   var pass = document.getElementById("password"); 
   if(pass.value.length==0){ 
      layer.tips('请输入密码','#password');  
      pass.focus(); 
      return false; 
    } 
    if(pass.value.length<6){ 
         layer.tips('请输入正确的密码','#password');  
         pass.value = ""; 
         pass.focus(); 
         return false; 
    }
}

