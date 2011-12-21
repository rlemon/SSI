<!DOCTYPE HTML>
<html>
<head>
	<title>SSI</title>

	<link rel="stylesheet" href="<?php echo URL; ?>public/css/jquery-ui.css" />
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
</head>
<body>

<?php Session::init(); ?>

<div class="wrapper">
	<div class="header ui-corner-top">
		<div class="ui-priority-primary ui-padded-all">DryerMaster SSI 2011-2012</div>
		<ul>
			<?php if( Session::get('loggedIn') != true ) { ?>
			<li>
				<a class="ui-btn" href="<?php echo URL; ?>login">Login</a>
			</li>
			<?php } else { ?>
			<li>
				<a class="ui-btn" href="<?php echo URL; ?>dashboard">Dashboard</a>
			</li>
			<li>
				<a class="ui-btn" href="<?php echo URL; ?>shipping">Shipping</a>
			</li>
			
			<li>
				<a class="ui-btn" href="<?php echo URL; ?>sales">Sales</a>
			</li>
			
			<li>
				<a class="ui-btn" href="<?php echo URL; ?>inventory">Inventory</a>
			</li>
			<?php } ?>
			<li>
				<a class="ui-btn" href="<?php echo URL; ?>help">Help</a>
			</li>
			<?php if( Session::get('loggedIn') ) { ?>
			<li>
				<a class="ui-btn" href="<?php echo URL; ?>dashboard/logout">Logout</a>
			</li>
			<?php } ?>
		</ul>
	</div>
	<div class="content">
