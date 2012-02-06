<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dryer Master Web 2.0</title>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('public_files/css/main.css'); ?>" />
    <?php if( isset( $styles ) ): ?>
        <?php foreach( $styles as $sheet ): ?>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo $sheet; ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
<div class="page">
<div class="header clearfix">
    <img src="<?php echo base_url('public_files/images/logo_001.png'); ?>" alt="Dryer Master Web 2.0" title="Dryer Master Web 2.0" />
</div>
<div class="main_menu clearfix">
    <ul class="gradient clearfix">
        <li class="first">
            <?php echo anchor('dashboard/', 'Dashboard'); ?>
        </li>
        <li>
            <?php echo anchor('inventory/', 'Inventory'); ?>
        </li>
        <li>
            <?php echo anchor('sales/', 'Sales'); ?>
        </li>
        <li>
            <?php echo anchor('shipping/', 'Shipping'); ?>
        </li>
        <li>
            <?php echo anchor('help/', 'Help'); ?>
        </li>
        <li class="last">
            <?php echo anchor('auth/logout/', 'Logout'); ?>
        </li>
    </ul>
</div>

<div class="content-wrapper">
