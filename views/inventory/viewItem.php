<?php
/* View page? really robbie, you can do better than this
 * view/add/edit should really be one page, with a type option passed into it.
 */
$item = isset( $this->items[ 1 ][ 0 ] ) ? $this->items[ 1 ][ 0 ] : $this->items;
$selected_groups = '';
for ( $i = 0, $l = count( $item[ 'groups' ] ); $i < $l; $i++ ) {
	$selected_groups .= <<<ITM
	<div class="filter_menu_item">
		{$item['groups'][$i]['name']}
	</div>
ITM;
}
?>
<div class="ui-padded-bottom ui-heading">
	Item <?php echo $item['id']; ?>
</div>
<div class="iblock ui-padded-all">
<input type="hidden" name="id" value="<?php echo $item['id']; ?>" />

<table class="view-table">
	<tr>
		<td>
			Part Code (P.C)
		</td>
		<td>
			<?php echo $item['part_code']; ?>
		</td>
		<td>
			Supplier
		</td>
		<td>
			<?php echo $item['part_supplier_name']; ?>
		</td>
	</tr>
	<tr>
		<td>
			Description
		</td>
		<td>
			<?php echo $item['part_description']; ?>
		</td>
		<td>
			Supplier P.C
		</td>
		<td>
			<?php echo $item['supplier_part_code']; ?>
		</td>
	</tr>
	<tr>
		<td>
			LOC
		</td>
		<td>
			<?php echo $item['loc']; ?>
		</td>
		<td>
			Unit Cost (CND)
		</td>
		<td>
			<?php echo $item['unit_cost']; ?>
		</td>
	</tr>
	<tr>
		<td valign="top">
			QTY
		</td>
		<td valign="top">
			<?php echo $item['qty']; ?>
		</td>
		<td valign="top">
			Group(s)
		</td>
		<td>
			<?php echo $selected_groups; ?>
		</td>
	</tr>
</table>
</div>

<?php echo save_cancel_buttons($this->refer, false); ?>

</form>

