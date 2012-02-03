var xhr_load_links = getby.class('xhr-load');
var xhr_load_links_click = function(e) {
	e.preventDefault();
	var _this = this;
    xhr.get({
        url: _this.href,
        success: function(data) {
			document.getElementById('content-area').innerHTML = data.responseText;
        },
        failure: function(data) {
			console.log(data);
			notifier.error(data.statusText, data.status);
		}
    });
};


for (var i = 0, l = xhr_load_links.length; i < l; i++) {
    addEventListener(xhr_load_links[i], 'click', xhr_load_links_click, true);
}
