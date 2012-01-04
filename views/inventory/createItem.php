<?php
$item = $this->itemDefaults;
$suppliers = $this->suppliers[ 1 ];
$groups = $this->groups[ 1 ];
$suppliers_options = '<option value="">- None -</option>';
for ( $i = 0, $l = count( $suppliers ); $i < $l; $i++ ) {
    $suppliers_options .= '<option value="' . $suppliers[ $i ][ 'id' ] . '">' . $suppliers[ $i ][ 'name' ] . '</option>';
}
$groups_options = '<option value="">- Add a Group -</option>';
for ( $i = 0, $l = count( $groups ); $i < $l; $i++ ) {
    $groups_options .= '<option value="' . $groups[ $i ][ 'id' ] . '">' . $groups[ $i ][ 'name' ] . '</option>';
}
?>
<div class="ui-padded-bottom ui-heading">
	Create New Item
</div>
<div class="iblock ui-padded-all">
<form method="post">
<table>
	<tr>
		<td>
			Part Code (P.C)
		</td>
		<td>
			<input type="text" name="part_code" value="<?php echo $item['part_code']; ?>" />
		</td>
		<td>
			Supplier
		</td>
		<td>
			<select class="ui-state-default" name="part_supplier_id">
				<?php echo $suppliers_options; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Description
		</td>
		<td>
			<input type="text" name="part_description" value="<?php echo $item['part_description']; ?>" />
		</td>
		<td>
			Supplier P.C
		</td>
		<td>
			<input type="text" name="supplier_part_code" value="<?php echo $item['supplier_part_code']; ?>" />
		</td>
	</tr>
	<tr>
		<td>
			LOC
		</td>
		<td>
			<input type="text" name="loc" value="<?php echo $item['loc']; ?>" />
		</td>
		<td>
			Unit Cost
		</td>
		<td>
			<input type="text" name="unit_cost" value="<?php echo $item['unit_cost']; ?>" />
		</td>
	</tr>
	<tr>
		<td valign="top">
			QTY
		</td>
		<td valign="top">
			<input type="text" name="qty" value="<?php echo $item['qty']; ?>" />
		</td>
		<td valign="top">
			Group(s)
		</td>
		<td>
			<select class="ui-state-default" id="filter_menu_groups" data-list-name="groups[]" >
				<?php echo $groups_options; ?>
			</select>
		</td>
	</tr>
</table>
</div>
<div class="ui-padded-all">
<input type="submit" name="submit" class="ui-btn small" value="Save" />
<a href="javascript:history.back();" class="ui-btn small" >Cancel</a>
</div>

</form>

