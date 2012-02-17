function make_toggle_checkbox(cb_id, block_id) {
	var checkbox = document.getElementById(cb_id);
	checkbox.onclick = function() {
		if( this.checked ) {
			document.getElementById(block_id).style.display = 'block';
		} else {
			document.getElementById(block_id).style.display = 'none';
		}
	};
}
make_toggle_checkbox('is_sales_ready','sales_price');
make_toggle_checkbox('is_manufactured','materials_list');
	
