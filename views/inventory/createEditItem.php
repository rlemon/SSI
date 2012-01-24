<?php
$item = isset( $this->items[ 1 ][ 0 ] ) ? $this->items[ 1 ][ 0 ] : $this->items;
$suppliers = $this->suppliers[ 1 ];
$groups = $this->groups[ 1 ];
/* can i also look into making this a little more streamlined.. this really should be part of the framework.. 
 * i will need to look into better design patterns for MVC for later versions.. possibly with better understanding
 * i should use a pre-fabd MVC framework */
$suppliers_options = '<option value="-1">- None -</option>';
for ( $i = 0, $l = count( $suppliers ); $i < $l; $i++ ) {
	$selected = '';
	if ( $item[ 'part_supplier_id' ] == $suppliers[ $i ][ 'id' ] ) {
		$selected = ' selected="selected" ';
	}
	$suppliers_options .= '<option value="' . $suppliers[ $i ][ 'id' ] . '" ' . $selected . '>' . $suppliers[ $i ][ 'name' ] . '</option>';
}
$selected_groups = '';
$groups_options = '<option value="">- Add a Group -</option>';
for ( $i = 0, $l = count( $groups ); $i < $l; $i++ ) {
	for ( $j = 0, $k = count( $item[ 'groups' ] ); $j < $k; $j++ ) {
		if ( $item[ 'groups' ][ $j ][ 'id' ] === $groups[ $i ][ 'id' ] ) {
			$selected_groups .= <<<ITM
			<div class="filter_menu_item">
				<input type="hidden" name="groups[]" value="{$groups[$i]['id']}" />
				{$groups[$i]['name']}<a class="ui-btn xsmall" data-icon-only="ui-icon-trash" onclick="$(this.parentNode).remove()">delete</a>
			</div>
ITM;
		}
	}
	$groups_options .= "\n\t\t\t\t" . '<option value="' . $groups[ $i ][ 'id' ] . '">' . $groups[ $i ][ 'name' ] . '</option>';
}
?>
<div class="ui-padded-bottom ui-heading">
<?php if( isset( $item['id'] ) ) { ?>
	Edit Item <?php echo $item['id']; ?>
<?php } else { ?>
	Create New Item
<?php } ?>
</div>
<div class="iblock ui-padded-all">
<form method="post" class="validate">
<?php if( isset( $item['id'] ) ) { ?>
	<input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
<? } ?>
<table>
	<tr>
		<td>
			Part Code (P.C)
		</td>
		<td>
			<input type="text" class="required" name="part_code" value="<?php echo $item['part_code']; ?>" />
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
			<input type="text" class="required" name="loc" value="<?php echo $item['loc']; ?>" />
		</td>
		<td>
			Unit Cost (CND)
		</td>
		<td>
			<input type="text" class="required number" name="unit_cost" value="<?php echo $item['unit_cost']; ?>" />
		</td>
	</tr>
	<tr>
		<td valign="top">
			QTY
		</td>
		<td valign="top">
			<input type="text" class="required number" name="qty" value="<?php echo $item['qty']; ?>" />
		</td>
		<td valign="top">
			Group(s)
		</td>
		<td>
			<select class="ui-state-default" id="filter_menu_groups" data-list-name="groups[]" >
				<?php echo $groups_options; ?>
			</select>
			<?php echo $selected_groups; ?>
		</td>
	</tr>
</table>
</div>

<?php echo save_cancel_buttons($this->refer); ?>

</form>

