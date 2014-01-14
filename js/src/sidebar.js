// Aliases both addEventListener and attachEvent so legacy IE (> 8) is supported
var addEvent = (function () {
   var filter = function(el, type, fn) {
      for ( var i = 0, len = el.length; i < len; i++ ) {
         addEvent(el[i], type, fn);
      }
   };
   if ( document.addEventListener ) {
      return function (el, type, fn) {
         if ( el && el.nodeName || el === window ) {
            el.addEventListener(type, fn, false);
         } else if (el && el.length) {
            filter(el, type, fn);
         }
      };
   }
 
   return function (el, type, fn) {
      if ( el && el.nodeName || el === window ) {
         el.attachEvent('on' + type, function () { return fn.call(el, window.event); });
      } else if ( el && el.length ) {
         filter(el, type, fn);
      }
   };
})();

// Just a nice function to toggle classes
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

// Calls functions on each element
addEvent( document.getElementById('sidebar_link'), 'click', function() {
	toggleClass(document.getElementById('sidebar'), 'visible')}
);

addEvent( document.getElementById('sidebar_top'), 'click', function() {
	toggleClass(document.getElementById('sidebar'), 'visible')}
);

// 50 lines of JS is the price of compatibility with IE 8. Curse you. 