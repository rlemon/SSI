

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

/* Filter Functions 
 * added 12/14/2011
 */


var toggle_filter_button = document.getElementById('btn-toggle-filter');
if(toggle_filter_button) {
	addEvent(toggle_filter_button, 'click', function(event) {
		event.preventDefault();
		var container = nextElementSibling(this.parentNode);
		if( this.textContent.indexOf('Show') === -1 ) {
			this.textContent = 'Show Filter Options';
			container.className = 'hidden';
		} else {
			this.textContent = 'Hide Filter Options';
			container.className = 'iblock';
		}
	}, false);
}
var frm = document.forms['filter'],
    list_groups = document.getElementsByClassName('filter_groups')[0],
    list_suppliers = document.getElementsByClassName('filter_suppliers')[0],
    array_groups = [],
    array_suppliers = [];

function addToList(selected, arr, list, delHandle) {
    if (!selected.value || arr.indexOf(selected.value) !== -1) {
        return;
    }
    var item = document.createElement('div'),
        del = document.createElement('a');
    item.appendChild(document.createTextNode(selected.textContent));
    del.addEventListener('click', delHandle, false);
    del.appendChild(document.createTextNode("[X]"));
    del.id = selected.value;
    item.appendChild(del);
    list.appendChild(item);
    arr.push(selected.value);
}

function removeFromList(obj, arr) {
    var match = obj.id;
    arr.splice(arr.indexOf(match), 1);
    var item = obj.parentNode;
    item.parentNode.removeChild(item);
}

var addGroupToList = function() {
    addToList(this[this.selectedIndex], array_groups, list_groups, function() {
        removeFromList(this, array_groups);
    });
    this[0].selected = true;
};
var addSupplierToList = function() {
    addToList(this[this.selectedIndex], array_suppliers, list_suppliers, function() {
        removeFromList(this, array_suppliers);
    });
    this[0].selected = true;
};


frm['groups'].addEventListener('change', addGroupToList, false);
frm['suppliers'].addEventListener('change', addSupplierToList, false);
