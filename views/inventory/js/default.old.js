/* New solution for part supplier 
 * 
 * Get the supplier list when the page loads for use in the add parts form and copy the nodes for use in the edit form. Select should function similar until refactored.
 */

var type = $("#tblListings").data("type");
var getUrl = type === "items" ? "inventory/xhrGetItems" : "/inventory/xhrGetSuppliers";
var updateUrl = type === "items" ? "inventory/xhrUpdateItem" : "/inventory/xhrUpdateSupplier";
function makeRows(obj, tbl) {
    var newRow = "<tr data-id='" + obj["id"] + "'>";
    for (key in obj) {
        if (key != "id") {
			if(key == "part_supplier_id") {
				newRow += "<td data-select='inventory/xhrGetSuppliers/true' data-key='part_supplier_id'>" + obj[key] + "</td>";
			} else {
				newRow += "<td data-key='" + key + "'>" + obj[key] + "</td>";
			}
        }
    }
    newRow += "</tr>";
    tbl.append(newRow);
}
$.get(getUrl, function(data) {
	//console.log(data);
    var obj = JSON.parse(data),
        tbl = $('#tblListings tbody');
    tbl.empty();
    for (var i = 0, l = obj.length; i < l; i++) {
        makeRows(obj[i], tbl);
    }
});

$('#addForm').submit(function() {
    var $this = $(this);
    var url = $this.attr('action');
    var $data = $this.serialize();
    $this.find("input").val("");
    $.post(url, $data , function(data) {
        makeRows(JSON.parse(data), $('#tblListings tbody'));
    });
    return false;
});

$("#addFormToggleBtn").click(function(e) {
    e.preventDefault();
    $("#addFormWrapper").toggle();
});

$("#tblListings tbody").on("click", "td", function(event) {
    if (event.target.tagName !== "TD") return;
    var cell = $(this);
    if (cell.data("select") != undefined) {
		$.post(cell.data("select"), function(data) {
			var obj = JSON.parse(data), sel = $("<select>"), cTxt = cell.text();
			for(var i = 0, l = obj.length; i < l; i++) {
				sel.append($("<option>",{value: obj[i].id, text: obj[i].name}));
				if(obj[i].name == cTxt) {
					sel.val(i+1);
				}
			}
			cell.append(sel);
			sel.focus();
			sel.on("change blur", function() {
				//console.log(cell.data("key") + " " + this.value);
				$.post(updateUrl, {
					id: cell.parent("tr").data("id"),
					update_key: cell.data("key"),
					update_value: this.value
				});
				var text = this.options[this.selectedIndex].innerText || this.options[this.selectedIndex].textContent;
				cell.css("padding", 6).text(text);
			});
		});
	} else {
		var input = $("<input>", {
			type: "text",
			value: cell.text(),
			maxlength: 128
		});
		cell.append(input);
		input.focus();
		input.on("blur", function() {
			$.post(updateUrl, {
				id: cell.parent("tr").data("id"),
				update_key: cell.data("key"),
				update_value: this.value
			});
			cell.css("padding", 6).text(this.value);
		});
	}
});
