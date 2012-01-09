<?php
$filter_term = isset($_GET['term']) ? $_GET['term'] : '';
$rpp = isset($_GET['rpp']) ? $_GET['rpp'] : RESULTS_PER_PAGE;
$ro = isset($_GET['ro']) ? $_GET['ro'] : 1;
$rowData = $this->rowData[1];

$order_by = isset($_GET['order']) ? $_GET['order'] : 'id';
$order_dir = isset($_GET['dir']) ? $_GET['dir'] : 'ASC';

$handle = '<span id="order_handle" class="ui-icon left ui-icon-triangle-1-'. ($order_dir == 'ASC' ? 's' : 'n') .'"></span>';

function hasHandle($identifier, $order_by, $handle) {
	if( $order_by == $identifier ) {
		return $handle;
	} else {
		return "";
	}
}
?>

<a class="ui-btn small" href="<?php echo URL; ?>inventory/itemList">Items</a>
<a class="ui-btn small" data-disabled="disabled" href="<?php echo URL; ?>inventory/groupList">Groups</a>
<a class="ui-btn small" href="<?php echo URL; ?>inventory/supplierList">Suppliers</a>
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

<input type="hidden" id="order_by" name="order" value="<?php echo $order_by; ?>" />
<input type="hidden" id="order_dir" name="dir" value="<?php echo $order_dir; ?>" />

<table class="ui-widget data-table">
	<thead class="ui-widget-header">
		<tr>
			<th class="static-column"><a href="#" class="order-by" name="id"><?php echo hasHandle('id', $order_by, $handle); ?>ID#</a></th>
			<th class="static-column"><a href="#" class="order-by" name="name"><?php echo hasHandle('name', $order_by, $handle); ?>Name</a></th>
			<th><a href="#" class="order-by" name="description"><?php echo hasHandle('description', $order_by, $handle); ?>Description</a></th>
			<th class="static-column">Actions</th>
		</tr>
	</thead>
	<tbody>
<?php
if( count($rowData) === 0 ) {
	echo '<tr><td colspan="4">No Records Found</td><td></td></tr>';
} else {
	for($i = 0, $l = count($rowData); $i < $l; $i++) {
		$r = $rowData[$i];
		$url = URL;
		$alt_style = $i%2 ? ' class="ui-widget-content"' : '';
		echo <<<ROWS
		<tr{$alt_style}>
			<td class="static-cell">{$r['id']}</td>
			<td class="static-cell">{$r['name']}</td>
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
<div class="ui-padded-top paging-buttons">
<span class="small">Page: </span>
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
	<a class="ui-btn small" data-icon="ui-icon-plus" href="<?php echo URL; ?>inventory/createGroup">New Group</a>
</div>
	</form>




