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
var xhr = {
	xmlhttp: (function() {
		var xmlhttp;
		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (er) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (err) {
					xmlhttp = false;
				}
			}
		}
		return xmlhttp;
	}()),
	post: function(options) {
		this.request.apply(this, ["POST", options]);
	},
	get: function(options) {
		this.request.apply(this, ["GET", options]);
	},
	request: function(type, options) {
		if (this.xmlhttp && options && 'url' in options) {
			var _xhr = this.xmlhttp;
			_xhr.open(type, options.url, true);
			_xhr.onreadystatechange = function() {
				if (_xhr.readyState == 4 && _xhr.status == 200) {
					if( typeof options.success  === 'function' ) {
						options.success.apply(this, [_xhr.responseText]);
					}
				} else {
					if( typeof options.failure === 'function' ) {
						options.failure.apply(this);
					}
				}
			};
			_xhr.send(null);
		}
	}
};
