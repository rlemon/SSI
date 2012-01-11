<?php
	$group = $this->groupDefaults;
?>
<div class="ui-padded-bottom ui-heading">
	Create New Group
</div>
<div class="iblock ui-padded-all">
<form method="post">
<table>
	<tr>
		<td>
			Name
		</td>
		<td>
			<input type="text" name="name" value="<?php echo $group['name']; ?>" />
		</td>
	</tr>
	<tr>
		<td>
			Description
		</td>
		<td>
			<input type="text" name="description" value="<?php echo $group['description']; ?>" />
		</td>
	</tr>
</table>
</div>

<?php echo save_cancel_buttons(); ?>

</form>

