<?php
function checkMenuItem($item, $override = false) {
	$ctrl = &$controller;
	$class = '';
	if( $ctrl == $item ) {
		$class .= ' selected';
	}
	if( !$override ) {
		return 'class="' . $class . '"';
	} else {
		return $class;
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dryer Master Web 2.0</title>
    <?php if( isset( $styles ) ): ?>
        <?php foreach( $styles as $sheet ): ?>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo $sheet; ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
<div class="page">
<div class="header clearfix">
    <img src="<?php echo base_url('application/assets/images/logo_001.png'); ?>" alt="Dryer Master Web 2.0" title="Dryer Master Web 2.0" />
</div>
<div class="main_menu clearfix">
    <ul class="gradient clearfix">
        <li class="first<?php echo checkMenuItem('dashboard', true); ?>">
            <?php echo anchor('/dashboard', 'Dashboard'); ?>
        </li>
        <li <?php checkMenuItem('inventory'); ?>>
            <?php echo anchor('/inventory', 'Inventory'); ?>
        </li>
        <li <?php checkMenuItem('sales'); ?>>
            <?php echo anchor('/sales', 'Sales'); ?>
        </li>
        <li <?php checkMenuItem('shipping'); ?>>
            <?php echo anchor('/shipping', 'Shipping'); ?>
        </li>
        <li <?php checkMenuItem('help'); ?>>
            <?php echo anchor('/help', 'Help'); ?>
        </li>
        <li class="last<?php echo checkMenuItem('auth', true); ?>">
            <?php
            if( !$logged_in ) {
				echo anchor('/auth/login', 'Login');
			} else {
				echo anchor('/auth/logout', 'Logout');
			}
            ?>
        </li>
    </ul>
</div>

<div class="content-wrapper">
