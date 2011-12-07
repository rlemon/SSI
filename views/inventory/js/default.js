/* Utility Functions specific to this page.. 
 */
function clearForm(frm) {
	for(var i = 0, l = frm.length; i < l; i++) {
		if( frm[i].type == 'text' ) {
			frm[i].value = "";
		} else if( frm[i].type == 'checkbox' ) {
			frm[i].checked = false;
		}
	}
}
/* Register the delete buttons functionality - basically a confirm and thats it
 */
var delete_buttons = document.getElementsByClassName('btn-delete');
for(var i = 0, l = delete_buttons.length; i < l; i++) {
	addEvent(delete_buttons[i], 'click', function(event) {
		if( !confirm('Are you sure you want to delete the following item?\n\nPart Code:\t' + this.dataset.partCode + '\nPart Desc:\t\t' + this.dataset.partDescription + '\n\nThis operation cannot be undone.') ) {
			event.preventDefault();
		}
	}, false);
}
/* Register the Clear Form button onclick
 */
var clear_button = document.getElementById('btn-clearForm');
addEvent(clear_button, 'click', function() {
	clearForm(this.parentNode);
}, false);
