<div class="column_01">
	<div class="menu_inline">
		<ul>
			<li class="selected">
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
			<li class="sub">
				<?php echo anchor('/dashboard/account_information/delete_account', 'Delete Account'); ?>
			</li>
		</ul>
	</div>
</div>

<div class="column_02">
	<div class="content">
		<h2 class="title_02">Account Information</h2>
		<div class="block_01">
		Username: <?php echo $userdata->username;?>
		</div>
		<div class="block_01">
		Email Address: <?php echo $userdata->email;?>
		</div>
		<div class="block_01">
		Registered: <?php echo $userdata->created;?>
		</div>
		<div class="block_01">
		Last Login: <?php echo $userdata->last_login;?>
		</div>
		<div class="block_01">
		Last Updated: <?php echo $userdata->modified;?>
		</div>
		<div class="block_01">
		Website: <?php echo $userdata->website;?>
		</div>
	</div>
</div>
