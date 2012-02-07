var Notifier = (function() {
    var Notifier = function(config) {
        this.config = {
            defaultTimeOut: 5000,
            position: ["top", "right"],
            notificationStyles: {
                padding: "12px 18px",
                margin: "0 0 6px 0",
                backgroundColor: "#000",
                opacity: 0.8,
                color: "#fff",
                font: "normal 13px 'Lucida Sans Unicode', 'Lucida Grande', Verdana, Arial, Helvetica, sans-serif",
                borderRadius: "3px",
                boxShadow: "#999 0 0 12px",
                width: "300px"
            },
            notificationStylesHover: {
                opacity: 1,
                boxShadow: "#000 0 0 12px"
            },
            container: document.createElement('div')
        };
        this.fn = {
            fadeout: function(element, callback) {
                var _this = this;
                if (element.style.opacity && element.style.opacity > 0.05) {
                    element.style.opacity = element.style.opacity - 0.05;
                } else if (element.style.opacity && element.style.opacity <= 0.1) {
                    callback.call(element);
                } else {
                    element.style.opacity = 0.9;
                }
                setTimeout(function() {
                    _this.fn.fadeout.apply(_this, [element, callback]);
                }, 1000 / 30);
            },
            applyStyles: function(element, styleObject) {
				for( prop in styleObject ) {
					element.style[prop] = styleObject[prop];
				}
			},
            notify: function(message, title, image) {
                var _this = this, timeout = this.config.defaultTimeout;
                var notification = document.createElement('div');
                notification.onmouseover = function() {
					 _this.fn.applyStyles.apply(this, [notification, _this.config.notificationStylesHover]);
				};
				notification.onmouseout = function() {
					 _this.fn.applyStyles.apply(this, [notification, _this.config.notificationStyles]);
				};
				notification.onmouseout();
                var ico = document.createElement('img');
                ico.src = image;
                ico.style.width = "36px";
                ico.style.height = "36px";
                ico.style.display = "inline-block";
                ico.style.verticalAlign = "middle";
                notification.appendChild(ico);

                var txt = document.createElement('div');
                txt.style.display = "inline-block";
                txt.style.verticalAlign = "middle";
                txt.style.padding = "0 12px";


                if (title) {
                    var _title = document.createElement('div');
                    _title.appendChild(document.createTextNode(title));
                    _title.style.fontWeight = "bold";
                    txt.appendChild(_title);
                }

                if (message) {
                    var _message = document.createElement('div');
                    _message.appendChild(document.createTextNode(message));
                    txt.appendChild(_message);
                }
                notification.onclick = function() {
                    this.style.display = 'none';
                };
                notification.appendChild(txt);
                _this.config.container.insertBefore(notification, _this.config.container.firstChild);
				setTimeout(function() {
					_this.fn.fadeout.apply(_this, [notification, function() { if( this.parentNode ) { this.parentNode.removeChild(this); } }]);
				}, _this.config.defaultTimeOut);
            },
            init: function() {
                var _cont = this.config.container;
                _cont.style.position = "fixed";
                _cont.style.zIndex = 9999;
                _cont.style[this.config.position[0]] = "12px";
                _cont.style[this.config.position[1]] = "12px";
                document.body.appendChild(_cont);
            }
        };
        this.fn.init.apply(this);
    };
    Notifier.prototype.info = function(message, title) {
        this.fn.notify.apply(this, [message, title, "public_files/images/info.png"]);
    };
    Notifier.prototype.warning = function(message, title) {
        this.fn.notify.apply(this, [message, title, "public_files/images/warning.png"]);
    };
    Notifier.prototype.error = function(message, title) {
        this.fn.notify.apply(this, [message, title, "public_files/images/error.png"]);
    };
    Notifier.prototype.success = function(message, title) {
        this.fn.notify.apply(this, [message, title, "public_files/images/success.png"]);
    };
    return Notifier;
})();
