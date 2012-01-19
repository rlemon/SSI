
$('#filter_limit').bind('change', function() {
	document.forms['filter'].submit();
});
$('#filter_menu_groups, #filter_menu_suppliers').bind('change', function() {
	var sel = this.options[this.selectedIndex], par = $(this.parentNode), isDuplicate = false;
	par.find('.filter_menu_item input').each(function() {
		if( this.value === sel.value ) {
			isDuplicate = true;
		}
	});
	if( this.selectedIndex !== 0 && !isDuplicate ) {
		var item = $('<div>', {
			'class': 'filter_menu_item'
		});
		var input = $('<input>', {
			'type': 'hidden',
			'name': this.getAttribute('data-list-name'),
			'value': sel.value
		});
		var icon = $('<a>', {
			'class': 'ui-btn xsmall',
			'data-icon-only': 'ui-icon-trash',
			'text': 'Delete',
			'click': function() {
				$(this.parentNode).remove();
			}
		});
		StyleButton(icon[0]); // call style button for all buttons due to specific style types
		item.append(input);
		item.append(sel.textContent || sel.innerText);
		item.append(icon);
		par.append(item);
	}
	this.selectedIndex = 0;
});

$('#btn-clear-term').bind('click', function(event) {
	event.preventDefault();
	$(this).prev().val('');
});

$('.order-by').bind('click', function(event) {
	event.preventDefault();
	var order_by = $('#order_by'), order_dir = $('#order_dir'); //, handle = $('#order_handle');
	if( order_by.val() == this.name ) {
		order_dir.val( order_dir.val() == 'ASC' ? 'DESC' : 'ASC' );
		//handle.removeClass('ui-icon-triangle-1-s').addClass('ui-icon-triangle-1-n');
	} else {
		order_by.val(this.name);
		order_dir.val('ASC');
		//handle.detach();
		//$(this).prepend(handle);
	}
	document.forms['filter'].submit();
});
jQuery.validator.messages.required = '';
$('form.validate').validate({
	errorClass: 'ui-state-error',
	errorElement: 'div',
	onkeyup: false,
	onfocusout: false
});

