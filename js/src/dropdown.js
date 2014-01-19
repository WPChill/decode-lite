[].forEach.call( document.querySelectorAll(".menu-item-has-children, .page_item_has_children"), function(el) {
	el.firstChild.addEventListener('click', function(e) {
		el.classList.toggle('open');
		e.preventDefault();
	}, false);
});