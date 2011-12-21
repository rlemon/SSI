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
	var item = $('<div class="filter_menu_item">');
	var input = $('<input type="hidden" name="' + this.getAttribute('data-list-name') + '" value="' + this.options[this.selectedIndex].value + '" />');
	var icon = $('<a class="ui-btn xsmall" data-icon-only="ui-icon-trash" onclick="$(this.parentNode).remove()">');
	icon.append('Delete');
	StyleButton(icon[0]); // call style button for all buttons due to specific style types
	item.append(input);
	item.append(this.options[this.selectedIndex].textContent);
	item.append(icon);
	$(this.parentNode).append(item);
	this.selectedIndex = 0;
 });


