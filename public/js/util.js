function addEvent(el, evt, func, capture) {
	if(el.attachEvent) {
		el.attachEvent('on' + evt, func);
	} else if(el.addEventListener) {
		el.addEventListener(evt, func, capture);
	}
}
