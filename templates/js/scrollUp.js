$(function(){$.scrollUp();});

(function($){
	$.scrollUp=function(options){
	var settings={
		scrollName:"scrollUp",
		topDistance:"100",
		topSpeed:500,
		animation:"fade",
		animationInSpeed:500,
		animationOutSpeed:500,
		scrollText:"返回顶部",
		activeOverlay:"false"
		};
		if(options)var settings=$.extend(settings,options);
		var sn="."+settings.scrollName,
		an=settings.animation,
		os=settings.animationOutSpeed,
		is=settings.animationInSpeed,
		td=settings.topDistance,st=settings.scrollText,
		ts=settings.topSpeed,ao=settings.activeOverlay;
		$("<a/>",{
			class:settings.scrollName,
			href:"",title:st,text:st
			}).appendTo("body");
			$(sn).css({
				"display":"none",
				"position":"fixed",
				"z-index":"1000"
				});
				if(ao){
					$("body").append(
					"<div class='"+settings.scrollName+"-active'></div>");
					$(sn+"-active").css({
						"position":"absolute",
						"top":td+"px",
						"width":"100%",
						"border-top":"1px dotted "+ao,
						"z-index":"1000"})}
						$(window).scroll(function(){
							if(an==="fade")
							$($(window).scrollTop()>td?$(sn).fadeIn(is):$(sn).fadeOut(os));
							else if(an==="slide")
							$($(window).scrollTop()>td?$(sn).slideDown(is):$(sn).slideUp(os));
							else $($(window).scrollTop()>td?$(sn).show(0):$(sn).hide(0))});
							$(sn).click(function(event){$("html, body").animate({scrollTop:0},ts);
							return false})}})(jQuery);