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
	$show = "";
} else {
	$dir = "login.php";
	$user = "未登录";
	$userstr = "未登录";
	$show = "hidden";
}
echo <<<END
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>$appname$userstr</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="validator/dist/jquery.validator.css" rel="stylesheet" />
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="validator/dist/jquery.validator.js"></script>
		<script src="validator/dist/local/zh-CN.js"></script>
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=dlHjsDiFbIOxn1eUvVUMGTZSE1uMjm3C"></script>
		<script src="js/common.js"></script>
		<style>
			.col-center-block {
				float: none;
				display: block;
				margin-left: auto;
				margin-right: auto;
			}
		</style>
	</head>

	<body id="body" style="background-color: #EEEEEE;">
END;
?>