$(document).ready(function()
{
    $(".smile ul li a img").hover(function()
	{
    	$(this).stop().animate({top:"-16px"}, 'slow', 'easeOutBounce' );
    },
	function()
	{
		$(this).stop().animate({top:"0"}, 300 );
	});
	
	$("li").hover(function()
	{
		$(this).addClass('hover');
		$('ul.lista').animate();
	},
	function()
	{
		$(this).removeClass('hover');	
	});
	
});

