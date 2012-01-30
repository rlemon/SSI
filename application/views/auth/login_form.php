<?php
/*
 * LOGIN FORM VIEW FILE
 */

$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => 'login name, or email',
	'maxlength'	=> 255
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => 'password'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember')
);
/*
 * see login_form.tmp
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);*/

?>

<?php echo form_open($this->uri->uri_string()); ?>
<div class="center-form">
	<h2 class="title_02">User Login</h2>
	<div class="center-input"><?php echo form_input($login); ?><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></div>
	<div class="center-input"><?php echo form_password($password); ?><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></div>
	<div class="center-options">
		<?php echo form_checkbox($remember); ?>
		<?php echo form_label('Remember me', $remember['id']); ?>
	</div>
	<div class="center-submit">
		<?php echo form_submit('submit', 'Login'); ?>
	</div>
	<div class="center-options ui-padded-top">
		<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
		<?php if ($this->config->item('allow_registration', 'tank_auth')) echo ' | ' . anchor('/auth/register/', 'Register'); ?>
	</div>
</div>
<?php echo form_close(); ?>
