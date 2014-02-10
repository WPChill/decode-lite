// Just a nice function to toggle classes. Could I use new JavaScript features? Yes. Am I going to? No, keeping at least IE 9 support for this feature.
function toggleClass(element, className){
    if (!element || !className){
        return;
    }
    
    var classString = element.className, nameIndex = classString.indexOf(className);
    if (nameIndex == -1) {
        classString += ' ' + className;
    }
    else {
        classString = classString.substr(0, nameIndex) + classString.substr(nameIndex+className.length);
    }
    element.className = classString;
}

// If it's a modern browser:
if (document.addEventListener) {
	document.getElementById('sidebar_link').addEventListener('click', function() {
		toggleClass(document.getElementById('sidebar'), 'visible');
	}, false);
	document.getElementById('sidebar_top').addEventListener('click', function() {
		toggleClass(document.getElementById('sidebar'), 'visible');
	}, false);
}

// If it's IE 8 or some crap like that:
else if (document.attachEvent)  {
	document.getElementById('sidebar_link').attachEvent('onclick', function() {
		toggleClass(document.getElementById('sidebar'), 'visible');
	});
	document.getElementById('sidebar_top').attachEvent('onclick', function() {
		toggleClass(document.getElementById('sidebar'), 'visible');
	});
}