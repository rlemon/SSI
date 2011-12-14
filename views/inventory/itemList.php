<?php
$filter_text = isset($_GET['text']) ? $_GET['text'] : '';

$suppliers_options = '<option value="">- Add a Supplier -</option>';
for($i = 0, $l = count($this->suppliers); $i < $l; $i++) {
	$suppliers_options .= '<option value="' . $this->suppliers[$i]['id'] . '">' . $this->suppliers[$i]['name'] . '</option>';
}

$groups_options = '<option value="">- Add a Group -</option>';
for($i = 0, $l = count($this->groups); $i < $l; $i++) {
	$groups_options .= '<option value="' . $this->groups[$i]['id'] . '">' . $this->groups[$i]['name'] . '</option>';
}

?>

<p>
	<a href="<?php echo URL; ?>inventory/supplierList">View Suppliers</a>
	<a href="<?php echo URL; ?>inventory/groupList">View Groups</a>
</p>
<p>
<a href="#" id="btn-toggle-filter">Hide Filter Options</a>
</p>
<div class="iblock">
	<form name="filter" method="get">
		<div class="filter_term">
			<label>Term:<input type="text" /></label>
		</div>
		<div class="filter_groups">
			<label>Groups:<select name="groups">
				<?php echo $groups_options; ?>
			</select></label>
		</div>
		<div class="filter_suppliers">
			<label>Suppliers:<select name="suppliers">
				<?php echo $suppliers_options; ?>
			</select></label>
		</div>
	</form>
</div>


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





