/*
 * auth.js
 * for all auth pages
 * not to be confused with validation
 */
(function() {
	
	var focusHandler = function() {
		if( this.value == this.getAttribute('value') ) {
			this.value = "";
		}
	};
	var blurHandler = function() {
		if( this.value == "" ) {
			this.value = this.getAttribute('value');
		}
	};
	var preSubmitClick = function() {
		for( var i = 0, l = elms.length; i < l; i++ ) {
			if( elms[i].type == 'text' || elms[i].type == 'password' ) {
				elms[i].value = elms[i].value == elms[i].getAttribute('value') ? '' : elms[i].value;
			}
		}
	};
	
	var frm = document.forms[0];
	var elms = frm.elements;
	for( var i = 0, l = elms.length; i < l; i++ ) {
		if( elms[i].type == 'text' || elms[i].type == 'password' ) {
			elms[i].addEventListener('focus', focusHandler);
			elms[i].addEventListener('blur', blurHandler);
		} else if( elms[i].type == 'submit' ) {
			elms[i].addEventListener('click', preSubmitClick);
		}
	}

})();
/*

	
	

	
	
	var login = getby.id('login'),
		password = getby.id('password'),

	login.addEventListener( 'focus', focusHandler);
	login.addEventListener( 'blur', blurHandler);
	password.addEventListener( 'focus', focusHandler);
	password.addEventListener( 'blur', blurHandler);
	
	document.forms[0].elements['submit'].addEventListener( 'click', function(e) {
		login.value = login.value == login.getAttribute('value') ? '' : login.value;
		password.value = password.value == password.getAttribute('value') ? '' : password.value;
	});
*/
