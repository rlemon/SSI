<?php
$filter_term = isset($_GET['term']) ? $_GET['term'] : '';

$selected_suppliers_list = isset($_GET['suppliers']) ? $_GET['suppliers'] : null;
$selected_groups_list = isset($_GET['groups']) ? $_GET['groups'] : null;

$selected_suppliers = '';
$selected_groups = '';

$suppliers_options = '<option value="">- Add a Supplier -</option>';
for($i = 0, $l = count($this->suppliers); $i < $l; $i++) {
	for($ii = 0, $ll = count($selected_suppliers_list); $ii < $ll; $ii++) {
		if( $selected_suppliers_list[$ii] === $this->suppliers[$i]['id'] ) {
			$selected_suppliers .= <<<ITM
			<div class="filter_menu_item">
				<input type="hidden" name="suppliers[]" value="{$this->suppliers[$i]['id']}" />
				{$this->suppliers[$i]['name']}<a class="ui-btn xsmall" data-icon-only="ui-icon-trash" onclick="$(this.parentNode).remove()">delete</a>
			</div>
ITM;
		}
	}
	$suppliers_options .= "\n\t\t\t\t" . '<option value="' . $this->suppliers[$i]['id'] . '">' . $this->suppliers[$i]['name'] . '</option>';
}

$groups_options = '<option value="">- Add a Group -</option>';
for($i = 0, $l = count($this->groups); $i < $l; $i++) {
	for($ii = 0, $ll = count($selected_groups_list); $ii < $ll; $ii++) {
		if( $selected_groups_list[$ii] === $this->groups[$i]['id'] ) {
			$selected_groups .= <<<ITM
			<div class="filter_menu_item">
				<input type="hidden" name="groups[]" value="{$this->groups[$i]['id']}" />
				{$this->groups[$i]['name']}<a class="ui-btn xsmall" data-icon-only="ui-icon-trash" onclick="$(this.parentNode).remove()">delete</a>
			</div>
ITM;
		}
	}
	$groups_options .= "\n\t\t\t\t" . '<option value="' . $this->groups[$i]['id'] . '">' . $this->groups[$i]['name'] . '</option>';
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
<div class="ui-padded-all">
	<form method="get" name="filter" id="filter">
		<div class="clearfix ui-padded-bottom">
			<label for="filter_term">Term</label>
			<input type="text" name="term" id="filter_term" value="<?php echo $filter_term; ?>" />
		</div>
		<div class="filter_menu">
			<label for="filter_menu_groups">Groups</label>
			<select id="filter_menu_groups" data-list-name="groups[]" >
				<?php echo $groups_options; ?>
			</select>
			<?php echo $selected_groups; ?>
		</div>
		<div class="filter_menu">
			<label for="filter_menu_suppliers">Suppliers</label>
			<select id="filter_menu_suppliers" data-list-name="suppliers[]">
				<?php echo $suppliers_options; ?>
			</select>
			<?php echo $selected_suppliers; ?>
		</div>
		<div class="clearfix ui-padded-top">
			<input class="ui-btn small" type="submit" value="Apply">
		</div>
	</form>
</div>

<table class="data-table">
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
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
		
		if( count($this->rowData) === 0 ) {
			echo '<tr><td colspan="10">No Records Found</td><td></td></tr>';
		} else {
			for($i = 0, $l = count($this->rowData); $i < $l; $i++) {
				$r = $this->rowData[$i];
				$groups = extractNames($r['groups']);
				$url = URL;
				echo <<<ROWS
		<tr>
			<td>{$r['id']}</td>
			<td>{$groups}</td>
			<td>{$r['part_code']}</td>
			<td>{$r['part_description']}</td>
			<td>{$r['part_supplier_name']}</td>
			<td>{$r['supplier_part_code']}</td>
			<td>{$r['loc']}</td>
			<td>{$r['qty']}</td>
			<td>{$r['unit_cost']}</td>
			<td>
				<a href="{$url}inventory/editItem/{$r['id']}" class="ui-btn" data-icon-only="ui-icon-pencil" title="Edit Item">Edit Item</a>
				<a href="{$url}inventory/deleteItem/{$r['id']}" class="ui-btn ui-btn-delete" data-icon-only="ui-icon-trash" title="Delete Item">Delete Item</a>
			</td>
		</tr>
ROWS;
			}
		}
		?>
	</tbody>
</table>


<p>
	<a href="<?php echo URL; ?>inventory/supplierList">View Suppliers</a>
	<a href="<?php echo URL; ?>inventory/groupList">View Groups</a>
</p>
<div class="btn-block toolbar">
	<a href="<?php echo URL; ?>inventory/createItem">+ New Item</a>
</div>





