<?php

session_start();
echo "<!DOCTYPE html> \n <html lang=\"zh-CN\"> <head>";

require_once 'function.php';

$userstr = '  (未登录)';
//未登录状态
if (isset($_SESSION['username'])) {
	$user = $_SESSION['username'];
	$userstr = "";
	$dir = "#";
} else {
	$dir = "signin.html";
	$user = "未登录";
}
echo <<<END
		<head>
		<title>$appname($userstr)</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="validator/dist/jquery.validator.css" rel="stylesheet" />
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="validator/dist/jquery.validator.js"></script>
		<script src="validator/dist/local/zh-CN.js"></script>
		<style>
			.col-center-block {
				float: none;
				display: block;
				margin-left: auto;
				margin-right: auto;
			}
		</style>
		<script>
		
			$(function() {
				// Custom theme
				$.validator.setTheme('bootstrap', {
					validClass: 'has-success',
					invalidClass: 'has-error',
					bindClassTo: '.form-group',
					formClass: 'n-default n-bootstrap',
					msgClass: 'n-right'
				});
			});
        </script>
		
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" style="width: 90px; padding: 10px ;"><img src="img/logo.png" style="width: 60px;" ></img></a>
				</div>
			</div>
		</nav>
END;
?>