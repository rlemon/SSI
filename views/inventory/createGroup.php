<?php
	$group = $this->groupDefaults;
?>
<a class='small-text' href="javascript:history.back();">&larr; Go Back</a>
<div class="indent">
	<div class="title">Create New Group</div>
	<form method="post">
	<table class="edit-form">
		<tr>
			<td>Name</td><td><input type="text" name="name" value="<?php echo $group['name']; ?>" /></td>
			<td>Description</td><td><input type="text" name="description" value="<?php echo $group['description']; ?>" /></td>
		</tr>
	</table>
	<div class="btn-block"><input type="submit" name="submit" value="Create Group" />&nbsp;<a href="javascript:history.back();">Cancel</a></div>
	</form>
</div>
