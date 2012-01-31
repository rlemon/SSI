var Notifier = (function() {
    var Notifier = function(options) {
        this.props = {
            delay: 5000,
            container: null,
            callback: null,
            confirm: null
        };
        this.fn = {
			 extend: function (target) {
				var objs = Array.prototype.slice.call(arguments, 1);
				objs.forEach(function (obj) {
					var props = Object.getOwnPropertyNames(obj);
					props.forEach(function (key) {
						target[key] = obj[key];
					});
				});
				return target;
			},
            showMessage: function(message, options) {
				if( typeof options !== 'undefined' ) {
					this.fn.extend.apply(this, [this.props, options]);
				}
				var _container = this.props.container;
				var buttons = '';
				if( this.props.confirm !== null ) {
					if( this.props.confirm.ok ) {
						buttons += '<button>J</button>';
					}
					if( this.props.confirm.cancel ) {
						buttons += '<button>X</button>';
					}
				} 
				_container.innerHTML = '<p>' + message + buttons + '</p>';
				_container.style.display = 'block';
				setTimeout( function() {
					_container.style.display = 'none';
					_container.innerHTML = '';
				}, this.props.delay);
            },
            init: function(options) {
				this.fn.extend.apply(this, [this.props, options]);
				if( !this.props.container ) {
					var bar = document.createElement('div');
					bar.className = 'notifier-bar';
					bar.style.display = 'none';
					document.getElementsByTagName('body')[0].appendChild(bar);
					this.props.container = bar;
				}
            }
        };
        this.fn.init.apply(this, [options]);
    };
    Notifier.prototype.say = function(message) {
		this.fn.showMessage.apply(this, [message]);
    };
    return Notifier;
})();
var n = new Notifier();
n.say("Hello World!", { confirm: {
		ok: true,
		cancel: true
	}});
