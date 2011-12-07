<!DOCTYPE HTML>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
</head>
<body>

<?php Session::init(); ?>
	
<div id="header" class='btn-block'>
	<?php if (Session::get('loggedIn') != true) { ?>
		<a href="<?php echo URL; ?>login">Login</a>
	<?php } else { ?>
		<a href="<?php echo URL; ?>dashboard">Dashboard</a>
		<a href="<?php echo URL; ?>inventory">Inventory</a>
		<?php if(Session::get('role') == 'owner') { ?>
			<a href="<?php echo URL; ?>user">Users</a>
		<?php } ?>
		<a href="<?php echo URL; ?>dashboard/logout">Logout</a>	
	<?php } ?>
	<a href="<?php echo URL; ?>help">Help</a>	
</div>
	
<div id="content">
	
	
