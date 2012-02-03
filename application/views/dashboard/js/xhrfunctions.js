var editable_elements = getby.class('editable');
var editable_click_handler = function(e) {
    var input_element = document.createElement('input');
    input_element.setAttribute('type', 'text');
    input_element.setAttribute('name', this.getAttribute('name'));
    input_element.setAttribute('data-url', this.getAttribute('data-url'));
    input_element.setAttribute('value', (this.innerText || this.textContent));
    this.parentNode.insertBefore(input_element, this);
    this.parentNode.removeChild(this);
    input_element.focus();
    addEventListener(input_element, 'blur', editable_blur_handler, true);
};
var editable_success_handler = function() {
    var span_element = document.createElement('span');
    span_element.className = 'editable';
    span_element.setAttribute('name', this.getAttribute('name'));
    span_element.setAttribute('data-url', this.getAttribute('data-url'));
    span_element.appendChild(document.createTextNode(this.value));
    this.parentNode.insertBefore(span_element, this);
    this.parentNode.removeChild(this);
    addEventListener(span_element, 'click', editable_click_handler, true);
};
var editable_blur_handler = function(e) {
	var _this = this;
    xhr.post({
        url: "/index.php/" + _this.getAttribute('data-url'),
        success: function(data) {
			data = JSON.parse(data);
			if( data.errors ) {
				notifier.warning(data.errors.login,"XHR Warning");
				_this.value = _this.getAttribute('value');
			} else {
				notifier.success("Your records have been updated.","XHR success");
				
			}
			editable_success_handler.apply(_this);
        },
        failure: function() {
			notifier.error("There was an error processing your request.","XHR error");
			_this.value = _this.getAttribute('value');
			editable_success_handler.apply(_this);
		},
        data: {
			"username": _this.value
        }
    });
};


for (var i = 0, l = editable_elements.length; i < l; i++) {
    addEventListener(editable_elements[i], 'click', editable_click_handler, true);
}
