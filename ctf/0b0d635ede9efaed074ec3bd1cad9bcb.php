<?php

$id = rand(0,1000);
if(isset($_COOKIE['id']))
	$id = (int)($_COOKIE['id']);
setcookie("id", $id);

if($id===1337)
	echo "C0gr4tz! FLAG is prodaft_{sessionimi_kim_buldu}";
else
	echo "Sorry :( you are not even close";

?>


