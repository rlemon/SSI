<?php
/*
 * PERSONAL OPTIONS VIEW FILE
 */
?>
<div class="column_01">
	<div class="menu_inline">
		<ul>
			<li>
				<?php echo anchor('/auth/change_email/', 'Change Email'); ?>
			</li>
			<li>
				<?php echo anchor('/auth/change_password/', 'Change Password'); ?>
			</li>
			<li>
				<?php echo anchor('/auth/unregister/', 'Delete Account'); ?>
			</li>
		</ul>
	</div>
</div>
<div class="column_02">
	<div class="content">
		<h2 class="title_02">Personal Options</h2>
		<p>
			<span class="label_02">Login: </span><?php echo $login ?>
		</p>
		<p>
			<span class="label_02">Email: </span><?php echo $email ?>
		</p>
		<p>
			<span class="label_02">Last Login: </span><?php ?>
		</p>
		<p>
			<span class="label_02">Registered on: </span><?php ?>
		</p>
	</div>
</div>
