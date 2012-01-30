var getby = {
	id: function(_id) { return document.getElementById(_id); },
	tag: function(_tag, context) { return (context || document).getElementsByTagName(_tag); },
	"class": function(_klass, context) { return (context || document).getElementsByClassName(_klass); }
}
var addEventListener = function( obj, evt, func, capture ) {
	if( typeof obj === 'undefined' || typeof evt === 'undefined' || typeof func === 'undefined' ) {
		return;
	}
	capture = capture || false;
	if( obj.addEventListener ) {
		obj.addEventListener( evt, func, capture );
	} else if( obj.attachEvent ) {
		obj.attachEvent( 'on' + evt, func );
	} else {
		throw "error attaching event.";
	}
}
