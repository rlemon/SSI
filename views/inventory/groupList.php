<?php
$filter_term = isset($_GET['term']) ? $_GET['term'] : '';
?>

<a class="ui-btn small" href="<?php echo URL; ?>inventory/itemList">Items</a>
<a class="ui-btn small" data-disabled="disabled" href="<?php echo URL; ?>inventory/groupList">Groups</a>
<a class="ui-btn small" href="<?php echo URL; ?>inventory/supplierList">Suppliers</a>

<div class="ui-padded-all iblock">
	<div class="ui-padded-bottom"><u>Filter Options</u></div>
	<form method="get" name="filter" id="filter">
		<div>
			<label for="filter_term">Term</label>
			<input type="text" name="term" id="filter_term" value="<?php echo $filter_term; ?>" />
			<a href="#" id="btn-clear-term" class="ui-btn xsmall ui-btn-inline" data-icon-only="ui-icon-cancel">Clear Field</a>
		</div>
		<div class="ui-padded-top">
			<input class="ui-btn small" type="submit" value="Apply">
		</div>
	</form>
</div>

<table class="data-table">
	<thead>
		<tr>
			<th class="static-column">ID#</th>
			<th class="static-column">Name</th>
			<th>Description</th>
			<th class="static-column">Actions</th>
		</tr>
	</thead>
	<tbody>
<?php
if( count($this->rowData) === 0 ) {
	echo '<tr><td colspan="4">No Records Found</td><td></td></tr>';
} else {
	for($i = 0, $l = count($this->rowData); $i < $l; $i++) {
		$r = $this->rowData[$i];
		$url = URL;
		echo <<<ROWS
		<tr>
			<td>{$r['id']}</td>
			<td class="nowrap">{$r['name']}</td>
			<td>{$r['description']}</td>
			<td><span>
				<a href="{$url}inventory/editGroup/{$r['id']}" class="ui-btn" data-icon-only="ui-icon-pencil" title="Edit Item">Edit Group</a>
				<a href="{$url}inventory/deleteGroup/{$r['id']}" class="ui-btn ui-btn-delete" data-icon-only="ui-icon-trash" title="Delete Item">Delete Group</a>
			</span></td>
		</tr>
ROWS;
	}
}
?>
    </tbody>
</table>

<div class="ui-padded-all">
	<a class="ui-btn small" data-icon="ui-icon-plus" href="<?php echo URL; ?>inventory/createGroup">New Group</a>
</div>





