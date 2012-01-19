<?php

// Use an autoloader!
require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';

// Library
require 'libs/Database.php';
require 'libs/Session.php';

require 'config/conf.php';
require 'config/database.php';
try {
	$app = new Bootstrap();
} catch( Exception $ex ) {
	require PATH_CONTROLLERS . 'error.php';
	$controller = new Error();
	$controller->index($ex->getMessage());
}
