function StyleButton(elm) {
	if( elm.getAttribute('data-icon-only') || elm.getAttribute('data-icon') ) {
		$(elm).button({
			icons: {
				primary: elm.getAttribute('data-icon') || elm.getAttribute('data-icon-only')
			},
			text: elm.getAttribute('data-icon-only') ? false : true
		});
	} else {
		$(elm).button();
	}
	
	if( elm.getAttribute('data-disabled') ) {
		$(elm).button('option', 'disabled', true);
	}
}

$('.ui-btn').each(function() {
	StyleButton(this);
});


