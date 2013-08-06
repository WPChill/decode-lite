jQuery(document).ready(function($){
	$(function() {
		FastClick.attach(document.body);
	});
	$("#sidebar_link, #sidebar_top").click(function(){
		$('#sidebar').toggleClass('visible');
	});
	$(window).swipe( {
	
	threshold:150, maxTimeThreshold:1000,
	swipeRight:function(event, distance, duration, fingerCount) {
		
		$('#sidebar.left').addClass('visible');
		$('#sidebar.right').removeClass('visible');
	},
	
	threshold:150, maxTimeThreshold:1000,
	swipeLeft:function(event, distance, duration, fingerCount) {
		
		$('#sidebar.left').removeClass('visible');
		$('#sidebar.right').addClass('visible');
	}
	});
});