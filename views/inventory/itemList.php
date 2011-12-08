<?php
$filter_text = isset($_GET['text']) ? $_GET['text'] : '';

$suppliers_options = '';
$filter_suppliers = isset($_GET['suppliers']) ? $_GET['suppliers'] : array();
for($i = 0, $l = count($this->suppliers); $i < $l; $i++) {
	$checked = '';
	for($j = 0, $k = count($filter_suppliers); $j < $k; $j++) {
		if( $this->suppliers[$i]['id'] === $filter_suppliers[$j] ) {
			$checked = 'checked="checked"';
		}
	}
	$suppliers_options .= '<label><input type="checkbox" ' . $checked . ' name="suppliers[]" value="' . $this->suppliers[$i]['id'] . '" />' . $this->suppliers[$i]['name'] . '</label>';
}
$groups_options = '';
$filter_groups = isset($_GET['groups']) ? $_GET['groups'] : array();
for($i = 0, $l = count($this->groups); $i < $l; $i++) {
	$checked = '';
	for($j = 0, $k = count($filter_groups); $j < $k; $j++) {
		if( $this->groups[$i]['id'] === $filter_groups[$j] ) {
			$checked = 'checked="checked"';
		}
	}
	$groups_options .= '<label><input type="checkbox" ' . $checked . ' name="groups[]" value="' . $this->groups[$i]['id'] . '" />' . $this->groups[$i]['name'] . '</label>';
}
?>

<div class="btn-block toolbar">
	<a href="<?php echo URL; ?>inventory/supplierList">View Suppliers</a>
	<a href="<?php echo URL; ?>inventory/groupList">View Groups</a>
</div>

<hr />

<div><i><u>Filter Options</u></i></div>
<div class="btn-block toolbar">
		<form method="get" name="filter">
		<div>Term:
			<input type="text" name="text" value="<?php echo $filter_text; ?>" />
		</div>
		<div>Suppliers:
			<?php echo $suppliers_options; ?>
		</div>
		<div>Groups:
			<?php echo $groups_options; ?>
		</div>
		<input type="submit" value="Apply Filter" />&nbsp;
		<input type="button" value="Clear Form" id="btn-clearForm" />
		
		</form>
</div>

<table>

</table>


<hr />

<table class="table-main" data-type="items">
	<thead>
		<tr>
			<th>ID#</th>
			<th>Group(s)</th>
			<th>Part Code (P.C)</th>
			<th>Description</th>
			<th>Supplier</th>
			<th>Supplier P.C</th>
			<th>LOC</th>
			<th>QTY</th>
			<th>Unit Cost (CND)</th>
		</tr>
	</thead>
	<tbody>
<?php
function extractNames($arr) {
	$ret = array();
	foreach($arr as $grp) {
		array_push($ret, $grp['name']);
	}
	return implode(', ', $ret);
}
if( count($this->rowData) === 0 ) {
	echo '<tr><td colspan="9">No Records Found</td><td></td></tr>';
} else {
	for($i = 0, $l = count($this->rowData); $i < $l; $i++) {
		$r = $this->rowData[$i];
		echo '<tr>' .
			'<td>' . $r['id'] . '</td>' .
			'<td data-type="check">' . extractNames($r['groups']) . '</td>' .
			'<td>' . $r['part_code'] . '</td>' .
			'<td>' . $r['part_description'] . '</td>' .
			'<td data-type="select">' . $r['part_supplier_name'] . '</td>' .
			'<td>' . $r['supplier_part_code'] . '</td>' .
			'<td>' . $r['loc'] . '</td>' .
			'<td>' . $r['qty'] . '</td>' .
			'<td>' . $r['unit_cost'] . '</td>' . 
			'<td class="btn-block"><form action="' . URL . 'inventory/editItem/'. $r['id'] . '"><input type="submit" title="Edit Item" value="E" /></form>' . /*'<a href="' . URL . 'inventory/editItem/'. $r['id'] . '" title="Edit Item" class="btn-edit">E</a>' . */
			'&nbsp;' .
			'<form class="frm-delete" action="' . URL . 'inventory/deleteItem/'. $r['id'] . '"><input type="hidden" name="id" value="' . $r['id'] . '" /><input type="submit" name="delete" title="Delete Item" value="D" /></form></td>' .
			'</tr>';
	}
}
?>
    </tbody>
</table>

<div class="btn-block toolbar">
	<a href="<?php echo URL; ?>inventory/createItem">+ New Item</a>
</div>





