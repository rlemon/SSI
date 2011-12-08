<?php
$filter_text = isset($_GET['text']) ? $_GET['text'] : '';
?>

	<a class="small-text" href="<?php echo URL; ?>inventory/itemList">&larr; Return to Item List</a>

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
		</tr>
	</thead>
	<tbody>
<?php
if( count($this->rowData) === 0 ) {
	echo '<tr><td colspan="4">No Records Found</td><td></td></tr>';
} else {
	for($i = 0, $l = count($this->rowData); $i < $l; $i++) {
		$r = $this->rowData[$i];
		echo '<tr>' .
			'<td>' . $r['id'] . '</td>' .
			'<td>' . $r['name'] . '</td>' .
			'<td>' . $r['description'] . '</td>' .
			'<td class="btn-block"><form action="' . URL . 'inventory/editGroup/'. $r['id'] . '"><input type="submit" value="E" title="Edit Group" /></form>' .
			'&nbsp;' .
			'<form class="frm-delete" action="' . URL . 'inventory/deleteGroup/'. $r['id'] . '"><input type="hidden" name="id" value="' . $r['id'] . '" /><input type="submit" name="delete" title="Delete Group" value="D" /></form></td>' .
			'</tr>';
	}
}
?>
    </tbody>
</table>

<div class="btn-block toolbar">
	<a href="<?php echo URL; ?>inventory/createGroup">+ New Group</a>
</div>





