<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
	'size' 	=> 29,
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 29,
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 29,
);
?>
<div class="column_01">
	<div class="menu_inline">
		<ul>
			<li>
				<?php echo anchor('/dashboard/account_information', 'Account Information'); ?>
			</li>
			<li class="sub">
				<?php echo anchor('/dashboard/account_information/change_username', 'Change Username'); ?>
			</li>
			<li class="sub">
				<?php echo anchor('/dashboard/account_information/change_email', 'Change Email'); ?>
			</li>
			<li class="sub selected">
				<?php echo anchor('/dashboard/account_information/change_password', 'Change Password'); ?>
			</li>
			<li class="sub">
				<?php echo anchor('/dashboard/account_information/delete_account', 'Delete Account'); ?>
			</li>
		</ul>
	</div>
</div>
<?php echo form_open($this->uri->uri_string()); ?>
<div class="column_02">
	<div class="content">
		<h2 class="title_02">Change Username</h2>
		<div class="block_01"><?php echo form_label('Old Password', $old_password['id']); ?><?php echo form_password($old_password); ?>
			<div class="ui-padded-tl small_text"><?php echo form_error($old_password['name']); ?></div>
		</div>
		<div class="block_01"><?php echo form_label('New Password', $new_password['id']); ?><?php echo form_password($new_password); ?>
			<div class="ui-padded-tl small_text"><?php echo form_error($new_password['name']); ?></div>
		</div>
		<div class="block_01"><?php echo form_label('Confirm New Password', $confirm_new_password['id']); ?><?php echo form_input($confirm_new_password); ?>
			<div class="ui-padded-tl small_text"><?php echo form_error($confirm_new_password['name']); ?></div>
		</div>
		
		<?php echo form_submit('change', 'Change Password'); ?>
	</div>
</div>
<?php echo form_close(); ?>
