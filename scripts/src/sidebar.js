( function () {
	'use strict';
	
	function DecodeSidebar( elements, VisibleClass ) {
		VisibleClass = VisibleClass || 'sidebar-visible';
		
		// Loop through the elements.
		var i;
		for ( i = 0; i < elements.length; i++ ) {
			var element = elements[i];
			
			// Check to see if the element exists before proceeding
			if ( document.getElementById( element ) ) {
				
				// If it's a modern browser:
				if ( document.addEventListener ) {
					document.getElementById( element ).addEventListener( 'click', toggleClass( document.body, VisibleClass ), false );
				}
				
				// If it's IE 8 or some crap like that:
				else if ( document.attachEvent ) {
					document.getElementById( element ).attachEvent( 'onclick', toggleClass( document.body, VisibleClass ) );
				}
			}
		}
		
		// Just a nice function to toggle classes. Could I use new JavaScript features? Yes. Am I going to? No, keeping at least IE 9 support for this feature.
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
	}
	
	DecodeSidebar.init = function( elements, VisibleClass ) {
		return new DecodeSidebar( elements, VisibleClass );
	};
	
	if ( typeof define == 'function' && typeof define.amd == 'object' && define.amd ) {
	
		// AMD. Register as an anonymous module.
		define( function() {
			return DecodeSidebar;
		} );
	} else if ( typeof module !== 'undefined' && module.exports ) {
		module.exports = DecodeSidebar.init;
		module.exports.DecodeSidebar = DecodeSidebar;
	} else {
		window.DecodeSidebar = DecodeSidebar;
	}
} )();