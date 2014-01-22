[].forEach.call( document.querySelectorAll(".menu-item-has-children, .page_item_has_children"), function(element) {
	element.firstChild.addEventListener('click', function(event) {
		
		if ( !(element.classList.contains('open')) ) {
			element.classList.toggle('open');
			event.preventDefault();
		}
		
	}, false);
});