<?php
$item = $this->items[0];

$suppliers_options = '<option value="-1">- None -</option>';
for($i = 0, $l = count($this->suppliers); $i < $l; $i++) {
	$selected = '';
	if( $item['part_supplier_id'] == $this->suppliers[$i]['id'] ) {
		$selected = ' selected="selected" ';
	}
	$suppliers_options .= '<option value="' . $this->suppliers[$i]['id'] . '" ' . $selected . '>' . $this->suppliers[$i]['name'] . '</option>';
}
$selected_groups = '';
$groups_options = '<option value="">- Add a Group -</option>';
for($i = 0, $l = count($this->groups); $i < $l; $i++) {
	for($j = 0, $k = count($item['groups']); $j < $k; $j++) {
		if( $item['groups'][$j]['id'] === $this->groups[$i]['id'] ) {
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

?>
<div class="ui-padded-bottom ui-heading">
	Edit Item <?php echo $item['id']; ?>
</div>
<div class="iblock ui-padded-all">
<form method="post">
<input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
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
			<select name="part_supplier_id">
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
			<select id="filter_menu_groups" data-list-name="groups[]" >
				<?php echo $groups_options; ?>
			</select>
			<?php echo $selected_groups; ?>
		</td>
	</tr>
</table>
</div>
<div class="ui-padded-all">
<input type="submit" name="submit" class="ui-btn small" value="Save" />
<a href="javascript:history.back();" class="ui-btn small" >Cancel</a>
</div>

</form>

