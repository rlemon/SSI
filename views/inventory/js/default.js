$('.ui-btn-delete').bind('click', function(event) {
	console.log($(this).closest('tr'));
	var cells = $(this).closest('tr').children();
	cells.addClass('ui-row-highlight');
	if( !confirm('Are you sure you want to delete this item?\nThis action cannot be undone.') ) {
		event.preventDefault();
	}
	cells.removeClass('ui-row-highlight');
});
/*
 <div class="filter_menu_item">
	{$this->suppliers[$i]['name']}<a class="ui-btn xsmall" data-id="{$this->suppliers[$i]['id']}" data-icon-only="ui-icon-trash" href="#">delete</a>
 </div>
 * */
 
 $('#filter_menu_groups, #filter_menu_suppliers').bind('change', function() {
	var item = $('<div class="filter_menu_item" data-id="' + this.options[this.selectedIndex].value + '">');
	var icon = $('<a class="ui-btn xsmall" data-icon-only="ui-icon-trash" onclick="$(this.parentNode).remove()">');
	icon.append('Delete');
	StyleButton(icon[0]); // call style button for all buttons due to specific style types
	item.append(this.options[this.selectedIndex].textContent);
	item.append(icon);
	$(this.parentNode).append(item);
 });

$(document.forms['filter']).bind('submit', function(event) {
	console.log(event);
	event.preventDefault();
	var args = {
		term: this.elements['term'].value,
		groups: [],
		suppliers: []
	};
	$('#filter_menu_groups').siblings('.filter_menu_item').each(function(i, el) {
		args.groups.push(el.dataset.id);
	});
	$('#filter_menu_suppliers').siblings('.filter_menu_item').each(function(i, el) {
		args.suppliers.push(el.dataset.id);
	});
	window.location = '?term=' + args.term + '&groups=' + args.groups.join(',') + '&suppliers=' + args.suppliers.join(',');
});
