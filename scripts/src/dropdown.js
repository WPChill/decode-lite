/**
 * A module for handling dropdown menus in Decode.
 * @module DecodeDropdown
 * @version 1.0.0
 */
var DecodeDropdown = ( function () {
	'use strict';
	
	/**
	 * Instantiate DecodeDropdown.
	 *
	 * @private
	 * @constructor
	 * @param {Object} Parent Elements that will have the class appended.
	 * @param {Object} Child Elements. If anything other than the child element is tapped, the Parent Element will have its active class removed.
	 * @param {String} Name of the class to be added to Parent Elements when they are active. Defaults to 'open'.
	 */
	function DecodeDropdown( parentElements, childElements, activeDropdownClass ) {
		activeDropdownClass = activeDropdownClass || 'open';
	
		// Loop through the parentElements.
		var i;
		for ( i = 0; i < parentElements.length; i++ ) {
			var element = parentElements[i];
			
			new OpenMenus( element, activeDropdownClass );
			
		}
			
		// Alias all the names for the matches() method.
		var matches;
		
		( function( doc ) {
			matches = 
				doc.matches ||                // Latest Satandard
				doc.matchesSelector ||        // Old Standard
				doc.webkitMatchesSelector ||  // Safari 5+
				doc.mozMatchesSelector ||     // Firefox 3.6+
				doc.oMatchesSelector ||       // Opera 15+, 11.5+
				doc.msMatchesSelector;        // IE 9+
		} )( document.documentElement );
		
		// Dismiss dropdowns after a tap on any non-menu element
		if ( ! ( document.querySelector( '.' + activeDropdownClass ) ) ) {
			document.addEventListener( 'click', function( event ) {
				
				// Loop through the childElements and output a string with a CSS selector for the open items.
				var i;
				var openItemSelector = '';
				for ( i = 0; i < childElements.length; i++ ) {
					var element = childElements[i];
					
					// Only add a comma if this is the second or greater time through the loop.
					if ( i > 0 ) {
						openItemSelector = openItemSelector + ', .' + element + '.' + 'open' + ' *';
					}
					// Otherwise, don't add a comma.
					else {
						openItemSelector = openItemSelector + '.' + element + '.' + 'open' + ' *';
					}
				}
				
				if ( ! ( matches.call( event.target, openItemSelector ) ) ) {
					new CloseMenus( activeDropdownClass );
				}
				
			}, false );
		}
	}
	
	/**
	 * Handles opening menus and closing currently open menus when a new menu is selected.
	 *
	 * @function OpenMenus
	 * @private
	 */
	function OpenMenus( element, activeDropdownClass ) {
		[].forEach.call( document.querySelectorAll( '.' + element ), function( element ) {
			element.firstChild.addEventListener( 'click', function( event ) {
				
				// Close other dropdowns unless they are a parent.
				if ( document.querySelector( '.' + activeDropdownClass ) && ! ( element.parentElement.parentElement.classList.contains( activeDropdownClass ) ) && ! ( element.classList.contains( activeDropdownClass ) ) ) {
					
					new CloseMenus( activeDropdownClass );
				}
				
				// Open the dropdown and don't open the link.
				if ( ! ( element.classList.contains( activeDropdownClass ) ) ) {
					element.classList.toggle( activeDropdownClass );
					event.preventDefault();
				}
				
				// Anything else and the link will open as normal.
				
			}, false );
		} );
	}
	
	/**
	 * Iterates over each element with the active dropdown class and removes it.
	 *
	 * @function CloseMenus
	 * @private
	 */
	function CloseMenus( activeDropdownClass ) {
		[].forEach.call( document.querySelectorAll('.' + activeDropdownClass ), function( element ) {
			element.classList.remove(activeDropdownClass);
		} );
	}
	
	/**
	 * Factory method for setting up DecodeDropdown.
	 *
	 * @param {Object} Parent Elements that will have the class appended.
	 * @param {Object} Child Elements. If anything other than the child element is tapped, the Parent Element will have its active class removed.
	 * @param {String} Name of the class to be added to Parent Elements when they are active. Defaults to 'open'.
	 */
	function init( parentElements, childElements, activeDropdownClass ) {
		return new DecodeDropdown( parentElements, childElements, activeDropdownClass );
	}
	
	return {
		init: init
	};
} )();