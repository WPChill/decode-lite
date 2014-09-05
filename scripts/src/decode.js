( function() {

	var decode = {
		
		// Init functions
		init: function() {
			this.FastClick();
			if ( Modernizr.touch ) {
				this.DecodeDropdown();
			}
			if ( document.getElementById( 'sidebar-link' ) ) {
				this.DecodeSidebar();
			}
		},
		
		// Initialize FastClick
		FastClick: function() {
			window.addEventListener('load', function() {
				FastClick.attach(document.body);
			}, false);
		},
		
		// Decode Dropdown function (compressed, see `dropdown.js`)
		DecodeDropdown: function() {
				
				/* jshint ignore:start */		
				var activeDropdownClass="open";
				[].forEach.call(document.querySelectorAll(".menu-item-has-children"),function(a){a.firstChild.addEventListener("click",function(b){!document.querySelector("."+activeDropdownClass)||a.parentElement.parentElement.classList.contains(activeDropdownClass)||a.classList.contains(activeDropdownClass)||[].forEach.call(document.querySelectorAll("."+activeDropdownClass),function(a){a.classList.remove(activeDropdownClass)});a.classList.contains(activeDropdownClass)||(a.classList.toggle(activeDropdownClass),b.preventDefault())},
				!1)});
				[].forEach.call(document.querySelectorAll(".page_item_has_children"),function(a){a.firstChild.addEventListener("click",function(b){!document.querySelector("."+activeDropdownClass)||a.parentElement.parentElement.classList.contains(activeDropdownClass)||a.classList.contains(activeDropdownClass)||[].forEach.call(document.querySelectorAll("."+activeDropdownClass),function(a){a.classList.remove(activeDropdownClass)});a.classList.contains(activeDropdownClass)||(a.classList.toggle(activeDropdownClass),b.preventDefault())},
				!1)});var matches;(function(a){matches=a.matches||a.matchesSelector||a.webkitMatchesSelector||a.mozMatchesSelector||a.oMatchesSelector||a.msMatchesSelector})(document.documentElement);
				document.querySelector("."+activeDropdownClass)||document.addEventListener("click",function(a){matches.call(a.target,".menu-item."+activeDropdownClass+" *, .page_item."+activeDropdownClass+" *")||[].forEach.call(document.querySelectorAll("."+activeDropdownClass),function(a){a.classList.remove(activeDropdownClass)})},!1);
				/* jshint ignore:end */
		},
		
		// Decode Dropdown function (see `sidebar.js`)
		DecodeSidebar: function() {
			window.addEventListener('load', function() {
				DecodeSidebar.init( 'sidebar-link' );
				DecodeSidebar.init( 'sidebar-top' );
			}, false);
		}
	};
	
	decode.init();
	
} )();