<?php
	$group = $this->groups[0];
?>
<a class='small-text' href="javascript:history.back();">&larr; Go Back</a>
<div class="indent">
	<div class="title">Edit Group &nbsp;&nbsp;&nbsp;&nbsp; ID: <?php echo $group['id']; ?></div>
	<form method="post">
	<input type="hidden" name="id" value="<?php echo $group['id']; ?>" />
	<table class="edit-form">
		<tr>
			<td>Name</td><td><input type="text" name="name" value="<?php echo $group['name']; ?>" /></td>
			<td>Description</td><td><input type="text" name="description" value="<?php echo $group['description']; ?>" /></td>
		</tr>
	</table>
	<div class="btn-block"><input type="submit" name="submit" value="Save Group" />&nbsp;<a href="javascript:history.back();">Cancel</a></div>
	</form>
</div>
