
[].forEach.call(document.querySelectorAll(".menu-item-has-children, .page_item_has_children"),function(element){element.firstChild.addEventListener('click',function(event){if(document.querySelector('.open')&&!(element.parentElement.parentElement.classList.contains('open'))&&!(element.classList.contains('open'))){document.querySelector('.open').classList.remove('open');}
if(!(element.classList.contains('open'))){element.classList.toggle('open');event.preventDefault();}},false);});
//@ sourceMappingURL=srcmaps/dropdown.js.map