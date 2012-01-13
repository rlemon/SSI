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

<input type="hidden" id="order_by" name="sort" value="<?php echo $this->sort; ?>" />
<input type="hidden" id="order_dir" name="order" value="<?php echo $this->order; ?>" />

<?php
	echo data_table( 'Item', array(
		array(
			'name' => 'id',
			'title' => 'ID',
			'is_static' => true
		),
		array(
			'name' => 'part_code',
			'title' => 'Part Code (P.C)',
			'is_static' => true
		),
		array(
			'name' => 'part_description',
			'title' => 'Description',
			'is_static' => false
		),
		array(
			'name' => 'part_supplier_name',
			'title' => 'Supplier',
			'is_static' => true
		),
		array(
			'name' => 'supplier_part_code',
			'title' => 'Supplier P.C',
			'is_static' => true
		),
		array(
			'name' => 'loc',
			'title' => 'LOC',
			'is_static' => true
		),
		array(
			'name' => 'qty',
			'title' => 'QTY',
			'is_static' => true
		),
		array(
			'name' => 'unit_cost',
			'title' => 'Unit Cost (CND)',
			'is_static' => true
		),
		array(
			'name' => 'actions',
			'title' => 'Actions',
			'is_static' => true
		)
	), $this->rowData[1], $this->sort, $this->order );
?>

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



