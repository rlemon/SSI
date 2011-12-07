<?php
	$item = $this->itemDefaults;
	$suppliers_options = '<option value="-1">- None -</option>';
	for($i = 0, $l = count($this->suppliers); $i < $l; $i++) {
		$suppliers_options .= '<option value="' . $this->suppliers[$i]['id'] . '">' . $this->suppliers[$i]['name'] . '</option>';
	}
	
	$groups_options = '';
	for($i = 0, $l = count($this->groups); $i < $l; $i++) {
		$groups_options .= '<label><input type="checkbox" name="groups[]" value="' . $this->groups[$i]['id'] . '">' . $this->groups[$i]['name'] . '</label>';
	}
?>
<a class='small-text' href="javascript:history.back();">&larr; Go Back</a>
<div class="indent">
	<div class="title">Create New Item</div>
	<form method="post">
	<table class="edit-form">
		<tr>
			<td>Part Code (P.C)</td><td><input type="text" name="part_code" value="<?php echo $item['part_code']; ?>" /></td>
			<td>LOC</td><td><input type="text" name="loc" value="<?php echo $item['loc']; ?>" /></td>
		</tr>
		<tr>
			<td>Description</td><td><input type="text" name="part_description" value="<?php echo $item['part_description']; ?>" /></td>
			<td>QTY</td><td><input type="text" name="qty" value="<?php echo $item['qty']; ?>" /></td>
		</tr>
		<tr>
			<td>Supplier</td><td><select name="part_supplier_id"><?php echo $suppliers_options; ?></select></td>
			<td>Unit Cost</td><td><input type="text" name="unit_cost" value="<?php echo $item['unit_cost']; ?>" /></td>
		</tr>
		<tr>
			<td>Supplier P.C</td><td><input type="text" name="supplier_part_code" value="<?php echo $item['supplier_part_code']; ?>" /></td>
			<td>Group(s)</td><td><?php echo $groups_options; ?></td>
		</tr>
	</table>
	<div class="btn-block"><input type="submit" name="submit" value="Create Item" />&nbsp;<a href="javascript:history.back();">Cancel</a></div>
	</form>
</div>
