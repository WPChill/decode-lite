jQuery(document).ready(function($){
	$(function() {
		FastClick.attach(document.body);
	});
	$("#sidebar_link, #sidebar_top").click(function(){
		$('#sidebar').toggleClass('visible');
	});
});