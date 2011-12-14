<!DOCTYPE HTML>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
</head>
<body>

<?php Session::init(); ?>
	
<div class="header">
	<?php if (Session::get('loggedIn') != true) { ?>
		<a class="ui-btn" href="<?php echo URL; ?>login">Login</a>
	<?php } else { ?>
		<a class="ui-btn" href="<?php echo URL; ?>dashboard">Dashboard</a>
		<a class="ui-btn" href="<?php echo URL; ?>inventory">Inventory</a>
		<?php if(Session::get('role') == 'owner') { ?>
			<a class="ui-btn" href="<?php echo URL; ?>user">Users</a>
		<?php } ?>
		<a class="ui-btn" href="<?php echo URL; ?>dashboard/logout">Logout</a>	
	<?php } ?>
	<a class="ui-btn" href="<?php echo URL; ?>help">Help</a>	
</div>
	
<div class="content">
	
	
