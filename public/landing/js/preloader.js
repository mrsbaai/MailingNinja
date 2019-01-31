$(document).ready(function(){
	$('#wrapper').prepend("<script>$(window).load(function() { $('.preloader img').fadeOut();$('.preloader').delay(500).fadeOut('slow');});</script>");
	$('#wrapper').prepend("<div class='preloader' style='position: fixed; width:100%;height:100%;background: #F5F5F5;top:0;z-index:9999;'></div>");
	$('#wrapper').removeClass('behind');
    document.getElementsByTagName("body")[0].style.visibility = "visible";
});