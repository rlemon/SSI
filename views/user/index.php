<div class="ui-widget ui-padded-all">
	<div class="ui-widget-header">User List</div>
	<div class="ui-widget-content">
		<form method="post" action="<?php echo URL;?>user/create">
		<table class="data-table">
			<tbody>
				<tr>
					<td><label for="username_input">Username</label></td>
					<td><input type="text" name="username" id="username_input" /></td>
				</tr>
				<tr>
					<td><label for="password_input">Password</label></td>
					<td><input type="text" name="password" id="password_input" /></td>
				</tr>
				<tr>
					<td><label for="role_input">Role</label></td>
					<td>
						<select name="role" id="role_input">
							<option value="default">Default</option>
							<option value="admin">Admin</option>
							<option value="owner">Owner</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" /></td>
				</tr>
			</tbody>
		</table>
		</form>
	</div>
</div>

<table class="ui-widget data-table">
	<thead class="ui-widget-header">
		<tr>
			<th class="static-column">ID</th>
			<th>Username</th>
			<th>Role</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$url = URL;
		foreach( $this->userList as $key => $value ) {
			echo <<<USERS
		<tr>
			<td>{$value['id']}</td>
			<td>{$value['username']}</td>
			<td>{$value['role']}</td>
			<td>
				<a href="{$url}user/edit/{$value['id']}" class="ui-btn" data-icon-only="ui-icon-pencil" title="Edit User">Edit User</a>
				<a href="{$url}user/delete/{$value['id']}" class="ui-btn ui-btn-delete" data-icon-only="ui-icon-trash" title="Edit User">Edit User</a>
			</td>
		</tr>
USERS;
		}
		?>
	</tbody>
</table>
