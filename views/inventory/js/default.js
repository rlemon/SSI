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
/* Register the Clear Form button onclick
 */
var clear_button = document.getElementById('btn-clearForm');
if(clear_button) {
	addEvent(clear_button, 'click', function() {
		clearForm(this.parentNode);
	}, false);
}

// delete buttons
var blockDelete = function(event) {
	if( !confirm('Are you sure you want to delete the following?\n\nID:\t' + this['id'].value + '\n\nThis operation cannot be undone.') ){
		event.preventDefault();
	}
};
var dels = document.getElementsByClassName('frm-delete'); // please please please find a better way to do this.
if(dels) {
	for(var i = 0, l = dels.length; i < l; i++) {
		dels[i].onsubmit = blockDelete;
	}
}
