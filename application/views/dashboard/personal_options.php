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
			<span class="label_02">Login: </span><span class="editable" name="username" data-url="auth/xhr_change_username/"><?php echo $login ?></span>
		</p>
		<p>
			<span class="label_02">Email: </span><span class="editable" name="email" data-url="auth/xhr_change_email/"><?php echo $email ?></span>
		</p>
		<p>
			<span class="label_02">Last Login: </span><?php ?>
		</p>
		<p>
			<span class="label_02">Registered on: </span><?php ?>
		</p>
		<p>
			<form action="http://localhost/index.php/auth/test" method="post" accept-charset="utf-8">
				<input type="text" name="test1" value="hello" />
				<input type="text" name="test2" value="world" />
				<input type="submit" value="Send" />
			</form>
		</p>
	</div>
</div>
