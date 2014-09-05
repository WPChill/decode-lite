( function () {
	function DecodeSidebar( element, visibleclass ) {
		visibleclass = visibleclass || 'sidebar-visible';
		
		// If it's a modern browser:
		if ( document.addEventListener ) {
			document.getElementById( element ).addEventListener( 'click', function() {
				toggleClass( document.body, 'sidebar-visible' );
			}, false );
		}
		
		// If it's IE 8 or some crap like that:
		else if ( document.attachEvent )  {
			document.getElementById( element ).attachEvent( 'onclick', function() {
				toggleClass( document.body, 'sidebar-visible' );
			} );
		}
			
		// Just a nice function to toggle classes. Could I use new JavaScript features? Yes. Am I going to? No, keeping at least IE 9 support for this feature.
		function toggleClass( element, className ) {
		    if (!element || !className){
		        return;
		    }
		    
		    var classString = element.className, nameIndex = classString.indexOf(className);
		    if (nameIndex === -1) {
		        classString += ' ' + className;
		    }
		    else {
		        classString = classString.substr(0, nameIndex) + classString.substr(nameIndex+className.length);
		    }
		    element.className = classString;
		}
	}
	
	DecodeSidebar.init = function( element, visibleclass ) {
		return new DecodeSidebar( element, visibleclass );
	};
	
	if (typeof define == 'function' && typeof define.amd == 'object' && define.amd) {
	
		// AMD. Register as an anonymous module.
		define(function() {
			return DecodeSidebar;
		});
	} else if (typeof module !== 'undefined' && module.exports) {
		module.exports = DecodeSidebar.init;
		module.exports.DecodeSidebar = DecodeSidebar;
	} else {
		window.DecodeSidebar = DecodeSidebar;
	}
} )();