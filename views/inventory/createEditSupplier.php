<?php
	$supplier = isset( $this->suppliers[ 1 ][ 0 ] ) ? $this->suppliers[ 1 ][ 0 ] : $this->suppliers;
?>
<div class="ui-padded-bottom ui-heading">
<?php if( isset( $supplier['id'] ) ) { ?>
	Edit Supplier <?php echo $supplier['id']; ?>
<?php } else { ?>
	Create New Supplier
<?php } ?>
</div>
<div class="iblock ui-padded-all">
<form method="post">
<?php if( isset( $supplier['id'] ) ) { ?>
	<input type="hidden" name="id" value="<?php echo $supplier['id']; ?>" />
<? } ?>
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
		<td valign="top">
			Address
		</td>
		<td>
			<input type="text" name="address_1" value="<?php echo $supplier['address_1']; ?>" /><br />
			<input type="text" name="address_2" value="<?php echo $supplier['address_2']; ?>" /><br />
			<input type="text" name="address_3" value="<?php echo $supplier['address_3']; ?>" />
		</td>
		<td>
			Email
		</td>
		<td>
			<input type="text" name="email" value="<?php echo $supplier['email']; ?>" />
		</td>
	</tr>
</table>
</div>

<?php echo save_cancel_buttons($this->refer); ?>

</form>
