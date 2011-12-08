<?php
	$supplier = $this->supplierDefaults;
?>
<a class='small-text' href="javascript:history.back();">&larr; Go Back</a>
<div class="indent">
	<div class="title">Create New Supplier</div>
	<form method="post">
	<table class="edit-form">
		<tr>
			<td>Name</td><td><input type="text" name="name" value="<?php echo $supplier['name']; ?>" /></td>
			<td>Telephone</td><td><input type="text" name="telephone" value="<?php echo $supplier['telephone']; ?>" /></td>
		</tr>
		<tr>
			<td>Description</td><td><input type="text" name="description" value="<?php echo $supplier['description']; ?>" /></td>
			<td>Fax</td><td><input type="text" name="fax" value="<?php echo $supplier['fax']; ?>" /></td>
		</tr>
		<tr>
			<td>Contact Name</td><td><input type="text" name="contact_name" value="<?php echo $supplier['contact_name']; ?>" /></td>
			<td>URL</td><td><input type="text" name="url" value="<?php echo $supplier['url']; ?>" /></td>
		</tr>
		<tr>
			<td>Email</td><td><input type="text" name="email" value="<?php echo $supplier['email']; ?>" /></td>
			<td></td><td></td>
		</tr>
	</table>
	<div class="btn-block"><input type="submit" name="submit" value="Create Supplier" />&nbsp;<a href="javascript:history.back();">Cancel</a></div>
	</form>
</div>
