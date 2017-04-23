$(document).ready(function() 
{ 
	$("#menu2>li").bind('mouseover',function() // ·Æ¹«²¾¤J¾Þ§@ 
	{ 
	chimg="../../images/"+$(this).find('img').attr('id')+"2.png";
	$(this).find('img').attr('src',chimg);
	$(this).children('ul').slideDown('fast');
	}).bind('mouseleave',function() // ·Æ¹«²¾¥X¾Þ§@ 
	{ 
	chimg="../../images/"+$(this).find('img').attr('id')+"1.png";
	$(this).find('img').attr('src',chimg);
	$(this).children('ul').slideUp('fast'); 
	}); 
	/*$('li.Banner').live({
		mouseenter:
			function(){
				$(this).children('a').css('color','#ffffff');
				},
		mouseleave:
			function(){
				$(this).children('a').css('color','#346086');
				}
	})*/
	$('li.Banner').bind('mouseenter',function(){
		
				$(this).children('a').css('background','#eaf874');
		
	})
	$('li.Banner').bind('mouseleave',function(){
		
				$(this).children('a').css('background','');
		
	})
});