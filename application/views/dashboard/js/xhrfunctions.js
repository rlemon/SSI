var editable_elements = getby.class('editable');

var editable_click_handler = function(e) {
	if( this.tagName !== 'INPUT' ) {
		var input_element = document.createElement('input');
		input_element.setAttribute('type', 'text');
		input_element.setAttribute('name', this.name);
		input_element.setAttribute('value', ( this.innerText || this.textContent ));
		this.parentNode.insertBefore(input_element, this);
		this.parentNode.removeChild(this);
		addEventListener(input_element, 'blur', editable_blur_handler, true);
	}
};
var editable_blur_handler = function(e) {
	console.log('here');
	xhr.post({
		url: "/index.php/auth/test/",
		success: function(data) { alert(data) },
		data: { test1: 'hello', test2: 'world'}
	});
}

for( var i = 0, l = editable_elements.length; i < l; i++ ) {
	addEventListener(editable_elements[i], 'click', editable_click_handler, true);
}
