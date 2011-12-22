<?php
$filter_term = isset($_GET['term']) ? $_GET['term'] : '';
?>


<a class="ui-btn small" href="<?php echo URL; ?>inventory/itemList">Items</a>
<a class="ui-btn small" href="<?php echo URL; ?>inventory/groupList">Groups</a>
<a class="ui-btn small" data-disabled="disabled" href="<?php echo URL; ?>inventory/supplierList">Suppliers</a>

<div class="ui-padded-all iblock">
	<div class="ui-padded-bottom"><u>Filter Options</u></div>
	<form method="get" name="filter" id="filter">
		<div>
			<label for="filter_term">Term</label>
			<input type="text" name="term" id="filter_term" value="<?php echo $filter_term; ?>" />
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
			<th class="static-column xlarge">Name</th>
			<th>Description</th>
			<th class="static-column xlarge">Contact Name</th>
			<th class="static-column">Email</th>
			<th class="static-column xlarge">Telephone</th>
			<th class="static-column xlarge">Fax</th>
			<th class="static-column">URL</th>
			<th class="static-column">Actions</th>
		</tr>
	</thead>
	<tbody>
<?php
if( count($this->rowData) === 0 ) {
	echo '<tr><td colspan="8">No Records Found</td><td></td></tr>';
} else {
	for($i = 0, $l = count($this->rowData); $i < $l; $i++) {
		$r = $this->rowData[$i];
		$url = URL;
		echo <<<ROWS
		<tr>
			<td>{$r['id']}</td>
			<td>{$r['name']}</td>
			<td>{$r['description']}</td>
			<td>{$r['contact_name']}</td>
			<td>{$r['email']}</td>
			<td>{$r['telephone']}</td>
			<td>{$r['fax']}</td>
			<td>{$r['url']}</td>
			<td>
				<a href="{$url}inventory/editSupplier/{$r['id']}" class="ui-btn" data-icon-only="ui-icon-pencil" title="Edit Item">Edit Group</a>
				<a href="{$url}inventory/deleteSupplier/{$r['id']}" class="ui-btn ui-btn-delete" data-icon-only="ui-icon-trash" title="Delete Item">Delete Group</a>
			</td>
		</tr>
ROWS;
	}
}
?>
    </tbody>
</table>

<div class="ui-padded-all">
	<a class="ui-btn small" data-icon="ui-icon-plus" href="<?php echo URL; ?>inventory/createSupplier">New Supplier</a>
</div>






