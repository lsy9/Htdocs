$(function(){
	$('.navList li').hover(function(){
		$(this).children('.subList').stop().toggle();
	})
});