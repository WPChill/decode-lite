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

// Runs FastClick on body
window.addEventListener('load', function() {
    FastClick.attach(document.body);
}, false);

// Where the magic happens
[].forEach.call( document.querySelectorAll("#sidebar_link, #sidebar_top"), function(el) {
	el.addEventListener('click', function() {
		toggleClass(document.getElementById('sidebar'), 'visible');
	}, false);
});