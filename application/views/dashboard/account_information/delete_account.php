<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
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
			<li class="sub">
				<?php echo anchor('/dashboard/account_information/change_password', 'Change Password'); ?>
			</li>
			<li class="sub selected">
				<?php echo anchor('/dashboard/account_information/delete_account', 'Delete Account'); ?>
			</li>
		</ul>
	</div>
</div>
<?php echo form_open($this->uri->uri_string()); ?>
<div class="column_02">
	<div class="content">
		<h2 class="title_02">Delete Account</h2>
		<div class="block_01"><?php echo form_label('Password', $password['id']); ?><?php echo form_input($password); ?>
			<div class="ui-padded-tl small_text"><?php echo form_error($password['name']); ?></div>
		</div>
		<?php echo form_submit('cancel', 'Delete account'); ?>
	</div>
</div>
<?php echo form_close(); ?>
