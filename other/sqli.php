<?php

//md5
//sha1 - 256 - 512
//SALT - KEY
/*if(isset($_GET['uname']))
{
	$uname = $_GET['uname'];
	$db = new mysqli('localhost', 'root', '', 'ab2016');
	$sql = "SELECT name FROM users WHERE uname='$uname'";
	"SELECT name FROM users WHERE uname='' UNION SELECT pw FROM users WHERE '1'='1'";
	$res = $db->prepare($sql);
	$res->execute();
	$res->store_result();
	$text="";
	$res->bind_result($text);
	if($res->num_rows==0)
		echo "No result found :(";
	else
		while($res->fetch())
			echo $text."<br/>\n";
}*/

if(isset($_POST['uname'], $_POST['pw']))
{
	$uname = $_POST['uname'];
	$sql = "SELECT salt,pw FROM users WHERE uname='$uname'";
	$db = new mysqli("localhost", "root", "", "ab2016");
	$res = $db->prepare($sql);
	$res->execute();
	$res->store_result();
	$salt = "";
	$pw = "";
	$res->bind_result($salt, $pw);
	$res->fetch();
	$hash = hash_hmac('sha256', $_POST['pw'], $salt);
	if($hash === $pw)
		echo "Login Successful";
	else
		echo "Wrong Password";
}

?>
<!--<form method="GET">
Search text: <input type='textbox' name='uname'/><br/>
<input type='submit' value='Search'/>
</form>-->


<form method="POST">
<input type="textbox" name='uname' /><br/>
<input type="password" name="pw" /><br/>
</form>
