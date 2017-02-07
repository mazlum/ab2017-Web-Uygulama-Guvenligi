<?php

$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

$whitelist = array("127.0.0.1", "::1");
$allow = false;
foreach($whitelist as $cur)
	if($ip==$cur)
		$allow = true;

if($allow===false)
	die("You are not allowed to view this page");

echo "Hello admin";
?>

