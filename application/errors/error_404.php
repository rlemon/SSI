<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>404 Error!</title>
		<link rel="stylesheet" type="text/css" media="all" href="http://localhost/application/assets/css/layout.css" />
		<style type="text/css" media="all">
		body {
			color: #4F5155;
		}
		
		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#container {
			margin: 0px 10px;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
		}

		p {
			margin: 12px 15px 12px 15px;
		}
		</style>
	</head>
<body>
	<div class="page">
		<div class="header clearfix">
			<img src="http://localhost/application/assets/images/logo_001.png" alt="Dryer Master Web 2.0" title="Dryer Master Web 2.0" />
		</div>
		<p>
			<a href="javascript:history.back();">&crarr; return</a>
		</p>
		<div id="container">
			<h1><?php echo $heading; ?></h1>
			<?php echo $message; ?>
		</div>
	</div>
</body>
</html>
