<?php
	$supplier = $this->suppliers[1][0];
?>
<div class="ui-padded-bottom ui-heading">
	Edit Supplier <?php echo $supplier['id']; ?>
</div>
<div class="iblock ui-padded-all">
<form method="post">
<input type="hidden" name="id" value="<?php echo $supplier['id']; ?>" />
<table>
	<tr>
		<td>
			Name
		</td>
		<td>
			<input type="text" name="name" value="<?php echo $supplier['name']; ?>" />
		</td>
		<td>
			Telephone
		</td>
		<td>
			<input type="text" name="telephone" value="<?php echo $supplier['telephone']; ?>" />
		</td>
	</tr>
	<tr>
		<td>
			Description
		</td>
		<td>
			<input type="text" name="description" value="<?php echo $supplier['description']; ?>" />
		</td>
		<td>
			Fax
		</td>
		<td>
			<input type="text" name="fax" value="<?php echo $supplier['fax']; ?>" />
		</td>
	</tr>
	<tr>
		<td>
			Contact Name
		</td>
		<td>
			<input type="text" name="contact_name" value="<?php echo $supplier['contact_name']; ?>" />
		</td>
		<td>
			URL
		</td>
		<td>
			<input type="text" name="url" value="<?php echo $supplier['url']; ?>" />
		</td>
	</tr>
	<tr>
		<td>
			Email
		</td>
		<td>
			<input type="text" name="email" value="<?php echo $supplier['email']; ?>" />
		</td>
		<td></td>
		<td></td>
	</tr>
</table>
</div>

<?php echo $save_cancel_buttons; ?>

</form>
