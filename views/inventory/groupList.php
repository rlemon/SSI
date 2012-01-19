<?php
$filter_term = isset($_GET['term']) ? $_GET['term'] : '';
$rowData = $this->rowData[1];
?>

<?php
	echo small_button( 1, array(
		array('title' => 'Items', 'url' => 'inventory/itemList'),
		array('title' => 'Groups', 'url' => 'inventory/groupList'),
		array('title' => 'Suppliers', 'url' => 'inventory/supplierList')
	) );
?>

	<form method="get" name="filter" id="filter">
<div class="ui-padded-all iblock">
	<div class="ui-padded-bottom"><u>Filter Options</u></div>
		<div class="ui-padded-bottom">
			<label for="filter_term">Term</label>
			<input type="text" name="term" id="filter_term" value="<?php echo $filter_term; ?>" />
			<a href="#" id="btn-clear-term" class="ui-btn xsmall ui-btn-inline" data-icon-only="ui-icon-cancel">Clear Field</a>
		</div>
		<div class="clearfix">
			<label for="filter_limit">Results Per Page</label>
			<select class="ui-state-default" name="limit" id="filter_limit">
				<?php
					foreach(array(5,10,25,50,100) as $value) {
						echo '<option value="' . $value . '" ';
						if( $this->limit == $value ) {
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

<input type="hidden" id="order_by" name="sort" value="<?php echo $this->sort; ?>" />
<input type="hidden" id="order_dir" name="order" value="<?php echo $this->order; ?>" />

<?php
	echo data_table( 'Group', array(
		array(
			'name' => 'id',
			'title' => 'ID',
			'is_static' => true
		),
		array(
			'name' => 'name',
			'title' => 'Name',
			'is_static' => true
		),
		array(
			'name' => 'description',
			'title' => 'Description',
			'is_static' => false
		),
		array(
			'name' => 'actions',
			'title' => 'Actions',
			'is_static' => true
		)
	), $this->rowData[1], $this->sort, $this->order, $this->limit, $this->page, $this->rowData[0] );
?>
<div class="ui-padded-all">
	<a class="ui-btn small" data-icon="ui-icon-plus" href="<?php echo URL; ?>inventory/createGroup">New Group</a>
</div>
	</form>




