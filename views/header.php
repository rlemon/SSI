<?php 
	Session::init();
	$theme_index = Session::get('ui_theme') != null ? Session::get('ui_theme') : 0;
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>SSI</title>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/<?php echo $this->themes[ $theme_index ]; ?>/jquery-ui.css" />
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
</head>
<body>

<div class="wrapper">
	<div class="header ui-corner-top ui-widget-header">
		<div class="ui-priority-primary ui-padded-all">DryerMaster SSI 2011-2012</div>
		<ul>
			<?php if( Session::get('logged_in') ) { ?>
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
			<?php if( Session::get('logged_in') ) { ?>
			<li>
				<a class="ui-btn" href="<?php echo URL; ?>dashboard/logout">Logout</a>
			</li>
			<?php } ?>
		</ul>
	</div>
	<div class="content ui-widget-content">
