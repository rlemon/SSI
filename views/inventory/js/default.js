$('.ui-btn-delete').bind('click', function(event) {
	console.log($(this).closest('tr'));
	var cells = $(this).closest('tr').children();
	cells.addClass('ui-row-highlight');
	if( !confirm('Are you sure you want to delete this item?\nThis action cannot be undone.') ) {
		event.preventDefault();
	}
	cells.removeClass('ui-row-highlight');
});
 
$('#filter_menu_groups, #filter_menu_suppliers').bind('change', function() {
	var sel = this.options[this.selectedIndex];
	if( this.selectedIndex !== 0 ) {
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
		$(this.parentNode).append(item);
		this.selectedIndex = 0;
	}
});

$('#btn-clear-term').bind('click', function(event) {
	event.preventDefault();
	$(this).prev().val('');
});

