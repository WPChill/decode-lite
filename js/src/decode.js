if ( Modernizr.touch ) {
	
	var activeDropdownClass="open";
	[].forEach.call(document.querySelectorAll(".menu-item-has-children"),function(a){a.firstChild.addEventListener("click",function(b){!document.querySelector("."+activeDropdownClass)||a.parentElement.parentElement.classList.contains(activeDropdownClass)||a.classList.contains(activeDropdownClass)||[].forEach.call(document.querySelectorAll("."+activeDropdownClass),function(a){a.classList.remove(activeDropdownClass)});a.classList.contains(activeDropdownClass)||(a.classList.toggle(activeDropdownClass),b.preventDefault())},
	!1)});
	[].forEach.call(document.querySelectorAll(".page_item_has_children"),function(a){a.firstChild.addEventListener("click",function(b){!document.querySelector("."+activeDropdownClass)||a.parentElement.parentElement.classList.contains(activeDropdownClass)||a.classList.contains(activeDropdownClass)||[].forEach.call(document.querySelectorAll("."+activeDropdownClass),function(a){a.classList.remove(activeDropdownClass)});a.classList.contains(activeDropdownClass)||(a.classList.toggle(activeDropdownClass),b.preventDefault())},
	!1)});var matches;(function(a){matches=a.matches||a.matchesSelector||a.webkitMatchesSelector||a.mozMatchesSelector||a.oMatchesSelector||a.msMatchesSelector})(document.documentElement);
	document.querySelector("."+activeDropdownClass)||document.addEventListener("click",function(a){matches.call(a.target,".menu-item."+activeDropdownClass+" *, .page_item."+activeDropdownClass+" *")||[].forEach.call(document.querySelectorAll("."+activeDropdownClass),function(a){a.classList.remove(activeDropdownClass)})},!1);

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