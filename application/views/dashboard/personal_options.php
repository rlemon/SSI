<?php
/*
 * PERSONAL OPTIONS VIEW FILE
 */
?>
<div class="column_01">
	<div class="menu_inline">
		<ul>
			<li>
				<?php echo anchor('/dashboard/personal_options/1', 'View Data','class="xhr-load"'); ?>
			</li>
			<li>
				<?php echo anchor('/auth/change_username/', 'Change Username','class="xhr-load"'); ?>
			</li>
			<li>
				<?php echo anchor('/auth/change_email/', 'Change Email','class="xhr-load"'); ?>
			</li>
			<li>
				<?php echo anchor('/auth/change_password/', 'Change Password','class="xhr-load"'); ?>
			</li>
			<li>
				<?php echo anchor('/auth/reset_password/', 'Force Reset Password','class="xhr-load"'); ?>
			</li>
			<li>
				<?php echo anchor('/auth/unregister/', 'Delete Account','class="xhr-load"'); ?>
			</li>
		</ul>
	</div>
</div>
<div class="column_02">
	<div class="content" id="content-area">
		<?php echo $default_view; ?>
	</div>
</div>
