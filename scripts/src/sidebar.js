/**
 * A module for handling sidebars in Decode.
 * @module DecodeSidebar
 * @version 1.0.0
 */
var DecodeSidebar = ( function () {
	'use strict';
	
	/**
	 * Instantiate DecodeSidebar.
	 *
	 * @private
	 * @constructor
	 * @param {Object} elements to listen on and toggle body class when clicked.
	 * @param {String} name of the class to be added to body when sidebar is active. Defaults to 'sidebar-visible'.
	 */
	function DecodeSidebar( elements, visibleClass ) {
		visibleClass = visibleClass || 'sidebar-visible';
		
		// Loop through the elements.
		var i;
		for ( i = 0; i < elements.length; i++ ) {
			var element = elements[i],
			    currentElement = document.getElementById( element );
			
			// Check to see if the element exists before proceeding
			if ( currentElement ) {
				
				// If it's a modern browser:
				if ( document.addEventListener ) {
					currentElement.addEventListener( 'click', toggleClass( document.body, visibleClass ), false );
				}
				
				// If it's IE 8 or some crap like that:
				else if ( document.attachEvent ) {
					currentElement.attachEvent( 'onclick', toggleClass( document.body, visibleClass ) );
				}
			}
		}
	}
	
	/**
	 * Just a nice function to toggle classes. 
	 * Could I use new JavaScript features? Yes. Am I going to? No, keeping at least IE 9 support for this feature.
	 *
	 * @function toggleClass
	 * @private
	 */
	function toggleClass( element, className ) {
		return function () {
			if ( !element || !className ) {
				return;
			}
			
			var classString = element.className, nameIndex = classString.indexOf( className );
			if ( nameIndex === -1 ) {
				classString += ' ' + className;
			}
			
			else {
				classString = classString.substr( 0, nameIndex ) + classString.substr( nameIndex + className.length );
			}
			
			element.className = classString;
		};
	}
	
	/**
	 * Factory method for setting up DecodeSidebar.
	 *
	 * @param {Object} elements to listen on and toggle body class when clicked.
	 * @param {String} name of the class to be added to body when sidebar is active. Defaults to 'sidebar-visible'.
	 */
	function init( elements, visibleClass ) {
		return new DecodeSidebar( elements, visibleClass );
	}
	
	return {
		init: init
	};
} )();