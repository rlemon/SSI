<?php
	$group = isset( $this->groups[ 1 ][ 0 ] ) ? $this->groups[ 1 ][ 0 ] : $this->groups;
?>
<div class="ui-padded-bottom ui-heading">
<?php if( isset( $group['id'] ) ) { ?>
	Edit Group <?php echo $group['id']; ?>
<?php } else { ?>
	Create New Group
<?php } ?>
</div>
<div class="iblock ui-padded-all">
<form method="post">
<?php if( isset( $group['id'] ) ) { ?>
	<input type="hidden" name="id" value="<?php echo $group['id']; ?>" />
<? } ?>
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

<?php echo save_cancel_buttons($this->refer); ?>
</form>

