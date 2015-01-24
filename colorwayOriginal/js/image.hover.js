
/*-----------------------------------------------------------------------------------*/
/*	IMAGE HOVER
/*-----------------------------------------------------------------------------------*/
jQuery(function() {
// OPACITY OF BUTTON SET TO 50%
jQuery('.columns img').css("opacity","1.0");	
// ON MOUSE OVER
jQuery('.columns img').hover(function () {										  
// SET OPACITY TO 100%
jQuery(this).stop().animate({ opacity: 0.75 }, "fast"); },	
// ON MOUSE OUT
function () {			
// SET OPACITY BACK TO 50%
jQuery(this).stop().animate({ opacity: 1.0 }, "fast");
});
});
