<?php
$filter_term = isset($_GET['term']) ? $_GET['term'] : '';
$rowData = $this->rowData[1];
$rpp = isset($_GET['rpp']) ? $_GET['rpp'] : RESULTS_PER_PAGE;
$ro = isset($_GET['ro']) ? $_GET['ro'] : 1;
?>
<a class="ui-btn small" href="<?php echo URL; ?>inventory/itemList">Items</a>
<a class="ui-btn small" href="<?php echo URL; ?>inventory/groupList">Groups</a>
<a class="ui-btn small" data-disabled="disabled" href="<?php echo URL; ?>inventory/supplierList">Suppliers</a>
	<form method="get" name="filter" id="filter">
<div class="ui-padded-all iblock">
	<div class="ui-padded-bottom"><u>Filter Options</u></div>

		<div class="ui-padded-bottom">
			<label for="filter_term">Term</label>
			<input type="text" name="term" id="filter_term" value="<?php echo $filter_term; ?>" />
			<a href="#" id="btn-clear-term" class="ui-btn xsmall ui-btn-inline" data-icon-only="ui-icon-cancel">Clear Field</a>
		</div>
		<div class="clearfix">
			<label for="filter_rpp">Results Per Page</label>
			<select class="ui-state-default" name="rpp" id="filter_rpp">
				<?php
					foreach(array(5,10,25,50,100) as $value) {
						echo '<option value="' . $value . '" ';
						if( $rpp == $value ) {
							echo 'selected="selected" ';
						}
						echo '>'. $value .'</option>';
					}
				?>
			</select>
		</div>
		<div class="ui-padded-top">
			<input class="ui-btn small" type="submit" value="Apply">
		</div>

</div>

<table class="data-table">
	<thead>
		<tr>
			<th class="static-column">ID#</th>
			<th class="static-column">Name</th>
			<th>Description</th>
			<th class="static-column">Contact Name</th>
			<th class="static-column">Email</th>
			<th class="static-column">Telephone</th>
			<th class="static-column">Fax</th>
			<th class="static-column">URL</th>
			<th class="static-column">Actions</th>
		</tr>
	</thead>
	<tbody>
<?php
if( count($rowData) === 0 ) {
	echo '<tr><td colspan="8">No Records Found</td><td></td></tr>';
} else {
	for($i = 0, $l = count($rowData); $i < $l; $i++) {
		$r = $rowData[$i];
		$url = URL;
		echo <<<ROWS
		<tr>
			<td>{$r['id']}</td>
			<td class="nowrap">{$r['name']}</td>
			<td>{$r['description']}</td>
			<td class="nowrap">{$r['contact_name']}</td>
			<td class="nowrap">{$r['email']}</td>
			<td class="nowrap">{$r['telephone']}</td>
			<td class="nowrap">{$r['fax']}</td>
			<td class="nowrap">{$r['url']}</td>
			<td><span>
				<a href="{$url}inventory/editSupplier/{$r['id']}" class="ui-btn" data-icon-only="ui-icon-pencil" title="Edit Item">Edit Group</a>
				<a href="{$url}inventory/deleteSupplier/{$r['id']}" class="ui-btn ui-btn-delete" data-icon-only="ui-icon-trash" title="Delete Item">Delete Group</a>
			</span></td>
		</tr>
ROWS;
	}
}
?>
    </tbody>
</table>
<div class="ui-padded-top paging-buttons">
<span class="label small">Page: </span>
<?php
	$pages = ceil($this->rowData[0] / $rpp);
	for( $i = 0; $i < $pages; $i++) {
		$disabled = '';
		if( $ro == ($i+1) ) {
			$disabled .= 'data-disabled="disabled" ';
		}
		echo '<input class="ui-btn xsmall" ' . $disabled . 'type="submit" name="ro" value="' . ($i+1) . '" />';
	}
?>
</div>
<div class="ui-padded-all">
	<a class="ui-btn small" data-icon="ui-icon-plus" href="<?php echo URL; ?>inventory/createSupplier">New Supplier</a>
</div>
	</form>





