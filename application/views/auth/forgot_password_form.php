<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => 'login name, or email',
	'maxlength'	=> 255
);
?>

<?php echo form_open($this->uri->uri_string()); ?>
<div class="center-form">
	<h2 class="title_02">Oops! You forgot your password!</h2>
	<div class="center-input"><?php echo form_input($login); ?><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></div>
	<div class="center-submit">
		<?php echo form_submit('reset', 'Reqest password reset'); ?>
	</div>
</div>
<?php echo form_close(); ?>
