function StyleButton(elm) {
	if( elm.getAttribute('data-icon-only') ) {
		$(elm).button({
			icons: {
				primary: elm.getAttribute('data-icon-only')
			},
			text: false
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


