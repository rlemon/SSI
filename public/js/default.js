function StyleButton(elm) {
	if( elm.dataset.iconOnly ) {
		$(elm).button({
			icons: {
				primary: elm.dataset.iconOnly
			},
			text: false
		});
	} else {
		$(elm).button();
	}
	
	if( elm.dataset.disabled ) {
		$(elm).button('option', 'disabled', true);
	}
}

$('.ui-btn').each(function() {
	StyleButton(this);
});


