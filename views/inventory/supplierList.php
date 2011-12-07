<?php
$filter_text = isset($_GET['text']) ? $_GET['text'] : '';
?>

<div class="btn-block toolbar">
	<a href="<?php echo URL; ?>inventory/itemList">View Items</a>
	<a href="<?php echo URL; ?>inventory/groupList">View Groups</a>
</div>

<hr />

<div><i><u>Filter Options</u></i></div>
<div class="btn-block toolbar">
		<form method="get" name="filter">
		<div>Term:
			<input type="text" name="text" value="<?php echo $filter_text; ?>" />
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
			<th>Name</th>
			<th>Description</th>
			<th>Contact Name</th>
			<th>Email</th>
			<th>Telephone</th>
			<th>Fax</th>
			<th>URL</th>
		</tr>
	</thead>
	<tbody>
<?php
if( count($this->rowData) === 0 ) {
	echo '<tr><td colspan="8">No Records Found</td><td></td></tr>';
} else {
	for($i = 0, $l = count($this->rowData); $i < $l; $i++) {
		$r = $this->rowData[$i];
		echo '<tr>' .
			'<td>' . $r['id'] . '</td>' .
			'<td>' . $r['name'] . '</td>' .
			'<td>' . $r['description'] . '</td>' .
			'<td>' . $r['contact_name'] . '</td>' .
			'<td>' . $r['email'] . '</td>' .
			'<td>' . $r['telephone'] . '</td>' .
			'<td>' . $r['fax'] . '</td>' .
			'<td>' . $r['url'] . '</td>' . 
			'<td class="btn-block"><form action="' . URL . 'inventory/editSupplier/'. $r['id'] . '"><input type="submit" value="E" /></form>' . /*'<a href="' . URL . 'inventory/editItem/'. $r['id'] . '" title="Edit Item" class="btn-edit">E</a>' . */
			'&nbsp;' .
			'<form class="frm-delete" action="' . URL . 'inventory/deleteSupplier/'. $r['id'] . '"><input type="hidden" name="id" value="' . $r['id'] . '" /><input type="submit" name="delete" value="D" /></form></td>' .
			'</tr>';
	}
}
?>
    </tbody>
</table>

<div class="btn-block toolbar">
	<a href="<?php echo URL; ?>inventory/createSupplier">+ New Supplier</a>
</div>




