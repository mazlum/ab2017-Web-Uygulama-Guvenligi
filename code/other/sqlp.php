<?php

if(isset($_GET['uname']))
{
	$uname = $_GET['uname'];
	$db = new mysqli('localhost', 'root', '', 'ab2016');
	$sql = "SELECT name FROM users WHERE uname=?";
	$res = $db->prepare($sql);
	$res->bind_param("s", $uname);
	$res->execute();
	$res->store_result();
	$text="";
	$res->bind_result($text);
	if($res->num_rows==0)
		echo "No result found :(";
	else
		while($res->fetch())
			echo $text."<br/>\n";
}
?>
<form method="GET">
Search text: <input type='textbox' name='uname'/><br/>
<input type='submit' value='Search'/>
</form>
