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
//$('select').selectmenu();
$('select').each(function() {
	this.className += " ui-state-default";
});
$('.ui-btn-delete').bind('click', function(event) {
	var cells = $(this).closest('tr').children();
	cells.addClass('ui-state-error');
	if( !confirm('Are you sure you want to delete this record?\nThis action cannot be undone.') ) {
		event.preventDefault();
	}
	cells.removeClass('ui-state-error');
});

function Notify(message, delay) {
	if (typeof message === 'undefined') {
		return;
	}
	delay = delay || 5000;
	var elm = $('<div>', {
		'text': message,
		'class': 'ui-state-hover ui-notify'
	});
	$('body').append(elm);
	elm.animate({
		'bottom': '0px'
	}, 300).delay(delay).animate({
		'bottom': '-65px'
	}, 300, function() {
		this.parentNode.removeChild(this);
	});
}
