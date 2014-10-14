( function () {
	'use strict';

	var decode = {
		
		// Init functions
		init: function() {
			this.FastClick();
			this.DecodeSidebar();
			if ( Modernizr.touch ) {
				this.DecodeDropdown();
			}
		},
		
		// Initialize FastClick (see `scripts/src/fastclick.js`)
		FastClick: function() {
			window.addEventListener( 'load', function() {
				FastClick.attach(document.body);
			}, false );
		},
		
		// Initialize DecodeSidebar (see `scripts/src/sidebar.js`)
		DecodeSidebar: function() {
			DecodeSidebar.init( ['sidebar-link', 'sidebar-top'] );
		},
		
		// Initialize DecodeDropdown (see `scripts/src/dropdown.js`)
		DecodeDropdown: function() {
			DecodeDropdown.init( ['menu-item-has-children', 'page_item_has_children'], ['menu-item', 'page_item'] );
		}
		
	};
	
	decode.init();
	
} )();