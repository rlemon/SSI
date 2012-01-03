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
<div class="ui-padded-all">
<input type="submit" name="submit" class="ui-btn small" value="Save" />
<a href="javascript:history.back();" class="ui-btn small" >Cancel</a>
</div>

</form>

