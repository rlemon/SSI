<?php
$filter_term = isset($_GET['term']) ? $_GET['term'] : '';
$rpp = isset($_GET['rpp']) ? $_GET['rpp'] : RESULTS_PER_PAGE;
$ro = isset($_GET['ro']) ? $_GET['ro'] : 1;
$selected_suppliers_list = isset($_GET['suppliers']) ? $_GET['suppliers'] : null;
$selected_groups_list = isset($_GET['groups']) ? $_GET['groups'] : null;

$selected_suppliers = '';
$selected_groups = '';

$suppliers = $this->suppliers[1];
$groups = $this->groups[1];
$rowData = $this->rowData[1];

$suppliers_options = '<option value="">- Add a Supplier -</option>';
for($i = 0, $l = count($suppliers); $i < $l; $i++) {
	for($ii = 0, $ll = count($selected_suppliers_list); $ii < $ll; $ii++) {
		if( $selected_suppliers_list[$ii] === $suppliers[$i]['id'] ) {
			$selected_suppliers .= <<<ITM
			<div class="filter_menu_item">
				<input type="hidden" name="suppliers[]" value="{$suppliers[$i]['id']}" />
				{$suppliers[$i]['name']}<a class="ui-btn xsmall" data-icon-only="ui-icon-trash" onclick="$(this.parentNode).remove()">delete</a>
			</div>
ITM;
		}
	}
	$suppliers_options .= "\n\t\t\t\t" . '<option value="' . $suppliers[$i]['id'] . '">' . $suppliers[$i]['name'] . '</option>';
}

$groups_options = '<option value="">- Add a Group -</option>';
for($i = 0, $l = count($groups); $i < $l; $i++) {
	for($ii = 0, $ll = count($selected_groups_list); $ii < $ll; $ii++) {
		if( $selected_groups_list[$ii] === $groups[$i]['id'] ) {
			$selected_groups .= <<<ITM
			<div class="filter_menu_item">
				<input type="hidden" name="groups[]" value="{$groups[$i]['id']}" />
				{$groups[$i]['name']}<a class="ui-btn xsmall" data-icon-only="ui-icon-trash" onclick="$(this.parentNode).remove()">delete</a>
			</div>
ITM;
		}
	}
	$groups_options .= "\n\t\t\t\t" . '<option value="' . $groups[$i]['id'] . '">' . $groups[$i]['name'] . '</option>';
}

function extractNames($arr) {
	$ret = array();
	foreach($arr as $grp) {
		array_push($ret, $grp['name']);
	}
	return implode(', ', $ret);
}

?>

<a class="ui-btn small" data-disabled="disabled" href="<?php echo URL; ?>inventory/itemList">Items</a>
<a class="ui-btn small" href="<?php echo URL; ?>inventory/groupList">Groups</a>
<a class="ui-btn small" href="<?php echo URL; ?>inventory/supplierList">Suppliers</a>

	<form method="get" name="filter" id="filter">
<div class="ui-padded-all iblock">
	<div class="ui-padded-bottom"><u>Filter Options</u></div>

		<div class="ui-padded-bottom">
			<label for="filter_term">Term</label>
			<input type="text" name="term" id="filter_term" value="<?php echo $filter_term; ?>" />
			<a href="#" id="btn-clear-term" class="ui-btn xsmall ui-btn-inline" data-icon-only="ui-icon-cancel">Clear Field</a>
		</div>
		<div class="clearfix ui-padded-bottom">
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
		<div class="filter_menu">
			<label for="filter_menu_groups">Groups</label>
			<select class="ui-state-default" id="filter_menu_groups" data-list-name="groups[]" >
				<?php echo $groups_options; ?>
			</select>
			<?php echo $selected_groups; ?>
		</div>
		<div class="filter_menu">
			<label for="filter_menu_suppliers">Suppliers</label>
			<select class="ui-state-default" id="filter_menu_suppliers" data-list-name="suppliers[]">
				<?php echo $suppliers_options; ?>
			</select>
			<?php echo $selected_suppliers; ?>
		</div>
		<div class="clearfix ui-padded-top">
			<input class="ui-btn small" type="submit" value="Apply">
		</div>

</div>

<input type="hidden" id="order_by" name="order" value="id" />
<input type="hidden" id="order_dir" name="dir" value="ASC" />

<table class="ui-widget data-table">
	<thead class="ui-widget-header">
			<th class="static-column"><a href=""><span class="ui-icon left ui-icon-triangle-1-s"></span>ID#</a></th>
			<th class="static-column">Group(s)</th>
			<th class="static-column">Part Code (P.C)</th>
			<th>Description</th>
			<th class="static-column">Supplier</th>
			<th class="static-column">Supplier P.C</th>
			<th class="static-column">LOC</th>
			<th class="static-column">QTY</th>
			<th class="static-column">Unit Cost (CND)</th>
			<th class="static-column">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
		
		if( count($rowData) === 0 ) {
			echo '<tr><td colspan="10">No Records Found</td><td></td></tr>';
		} else {
			for($i = 0, $l = count($rowData); $i < $l; $i++) {
				$r = $rowData[$i];
				$groups = extractNames($r['groups']);
				$url = URL;
				$alt_style = $i%2 ? ' class="ui-widget-content"' : '';
				echo <<<ROWS
		<tr{$alt_style}>
			<td class="static-cell">{$r['id']}</td>
			<td>{$groups}</td>
			<td class="static-cell">{$r['part_code']}</td>
			<td>{$r['part_description']}</td>
			<td class="static-cell">{$r['part_supplier_name']}</td>
			<td class="static-cell">{$r['supplier_part_code']}</td>
			<td class="static-cell">{$r['loc']}</td>
			<td class="static-cell">{$r['qty']}</td>
			<td class="static-cell">{$r['unit_cost']}</td>
			<td><span>
				<a href="{$url}inventory/editItem/{$r['id']}" class="ui-btn" data-icon-only="ui-icon-pencil" title="Edit Item">Edit Item</a>
				<a href="{$url}inventory/deleteItem/{$r['id']}" class="ui-btn ui-btn-delete" data-icon-only="ui-icon-trash" title="Delete Item">Delete Item</a>
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
	<a class="ui-btn small" data-icon="ui-icon-plus" href="<?php echo URL; ?>inventory/createItem">New Item</a>
</div>

	</form>



