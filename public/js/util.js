function addEvent(el, evt, func, capture) {
	if(el.attachEvent) {
		el.attachEvent('on' + evt, func);
	} else if(el.addEventListener) {
		el.addEventListener(evt, func, capture);
	}
}
function nextElementSibling(el) {
	if(el.nextElementSibling) {
		return el.nextElementSibling;
	}
	do { el = el.nextSibling } while ( el && el.nodeType !== 1 ); // Node.ELEMENT_NODE === 1
	return el;
}
