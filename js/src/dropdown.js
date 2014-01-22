/*
To Do:
[X]  Only keep one drop down open in a parent-child group
[X]  Opened links can be clicked
[ ]  Hide dropdowns by a tap anywhere

*/
[].forEach.call( document.querySelectorAll(".menu-item-has-children, .page_item_has_children"), function(element) {
	element.firstChild.addEventListener('click', function(event) {
		
		if ( document.querySelector('.open') && !(element.parentElement.parentElement.classList.contains('open')) && !(element.classList.contains('open')) ) {
			document.querySelector('.open').classList.remove('open');
		}
		
		if ( !(element.classList.contains('open')) ) {
			element.classList.toggle('open');
			event.preventDefault();
		}
						
	}, false);
});