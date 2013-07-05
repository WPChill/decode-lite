jQuery(document).ready(function($){
	$(function() {
		FastClick.attach(document.body);
	});
	$('.replytrigger').click(function(){
		$('.triggered').removeClass('triggered');
		$(this).closest('.reply').addClass('triggered');
	});
	$("#sidebar_link, #sidebar_top").click(function(){
		$('#sidebar').toggleClass('visible');
	});
});