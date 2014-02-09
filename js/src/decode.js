Modernizr.load({
	test: Modernizr.mq('only all'),
	nope: templateDir + '/js/respond.js?1.4.2'
});

if ( Modernizr.touch ) {
	
	var activeDropdownClass = 'open';
	
	// Select all .menu-item-has-children elements
	[].forEach.call( document.querySelectorAll(".menu-item-has-children"), function(element) {
		element.firstChild.addEventListener('click', function(event) {
			
			// Close other dropdowns unless they are a parent
			if ( document.querySelector('.' + activeDropdownClass) && !(element.parentElement.parentElement.classList.contains(activeDropdownClass)) && !(element.classList.contains(activeDropdownClass)) ) {
				// Iterate over each element with the active dropdown class and remove it
				[].forEach.call( document.querySelectorAll('.' + activeDropdownClass), function(element) {
					element.classList.remove(activeDropdownClass);
				});
			}
			
			// Open the dropdown and don't open the link
			if ( !(element.classList.contains(activeDropdownClass)) ) {
				element.classList.toggle(activeDropdownClass);
				event.preventDefault();
			}
			
			// Anything else and the link will open as normal
							
		}, false);
	});
	
	// Select all .page_item_has_children elements
	[].forEach.call( document.querySelectorAll(".page_item_has_children"), function(element) {
		element.firstChild.addEventListener('click', function(event) {
			
			// Close other dropdowns unless they are a parent
			if ( document.querySelector('.' + activeDropdownClass) && !(element.parentElement.parentElement.classList.contains(activeDropdownClass)) && !(element.classList.contains(activeDropdownClass)) ) {
				// Iterate over each element with the active dropdown class and remove it
				[].forEach.call( document.querySelectorAll('.' + activeDropdownClass), function(element) {
					element.classList.remove(activeDropdownClass);
				});
			}
			
			// Open the dropdown and don't open the link
			if ( !(element.classList.contains(activeDropdownClass)) ) {
				element.classList.toggle(activeDropdownClass);
				event.preventDefault();
			}
			
			// Anything else and the link will open as normal
							
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
	if ( !(document.querySelector('.' + activeDropdownClass)) ) {
		document.addEventListener('click', function(event) {
			if ( !(matches.call( event.target, '.menu-item' + '.' + activeDropdownClass + ' *' + ', .page_item' + '.' + activeDropdownClass + ' *' ) ) ) {
				// Iterate over each element with the active dropdown class and remove it
				[].forEach.call( document.querySelectorAll('.' + activeDropdownClass), function(element) {
					element.classList.remove(activeDropdownClass);
				});
			}
		}, false);
	}	

}

// Runs FastClick on body
// If it's a modern browser:
if (window.addEventListener) {
	window.addEventListener('load', function() {
		FastClick.attach(document.body);
	}, false);
}

// If it's IE 8 or some crap like that:
else if (window.attachEvent)  {
	window.attachEvent('onload', function() {
		FastClick.attach(document.body);
	});
}