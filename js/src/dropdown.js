[].forEach.call( document.querySelectorAll(".menu-item-has-children, .page_item_has_children"), function(element) {
	element.firstChild.addEventListener('click', function(event) {
		
		// Close other dropdowns unless they are a parent
		if ( document.querySelector('.open') && !(element.parentElement.parentElement.classList.contains('open')) && !(element.classList.contains('open')) ) {
			document.querySelector('.open').classList.remove('open');
		}
		
		// Open the dropdown and don't open the link
		if ( !(element.classList.contains('open')) ) {
			element.classList.toggle('open');
			event.preventDefault();
		}
						
	}, false);
});

// Alias all the names for the matches() method
var matches;

(function(doc) {
	matches = 
		doc.matches ||                // Latest Satandard
		doc.matchesSelector ||        // Old Standard
		doc.webkitMatchesSelector ||  // Safari 5+
		doc.mozMatchesSelector ||     // Firefox 3.6+
		doc.oMatchesSelector ||       // Opera 15+, 11.5+
		doc.msMatchesSelector;        // IE 9+
})(document.documentElement);

// Dismiss dropdowns after a tap on any non-menu element
if ( !(document.querySelector('.open')) ) {
	document.addEventListener('click', function(event) {
		if ( !(matches.call( event.target, '.menu *' ) ) ) {
			document.querySelector('.open').classList.toggle('open');
		}
	}, false);
}