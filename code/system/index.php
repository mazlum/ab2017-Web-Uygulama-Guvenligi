<?php
require_once "user.php";
require_once "info.php";

$loginform = <<<EOF
<form method="POST">
	<input type="textbox" name="uname">
	<input type="password" name="pwd">
	<input type="submit" name="action" value="Login">
</form>
EOF;

$regform = <<<EOF
<form method="POST">
	<input type="textbox" name="uname">
	<input type="password" name="pwd">
	<input type="submit" name="action" value="Register">
</form>
EOF;

session_start();
$loggedin = false;
if(isset($_SESSION['loggedin']))
	$loggedin = $_SESSION['loggedin'];

if($loggedin===false)//new coming user
{
	if(isset($_POST['action'], $_POST['uname'], $_POST['pwd']))
	{
		if($_POST['action']=='Login')
		{
			///Login Operations
			$u = new User();
			$res = $u->checkLogin($_POST['uname'], $_POST['pwd']);
			if($res)
			{
				echo "Login succesful";
				$_SESSION['loggedin'] = true;
				$_SESSION['user'] = $u;
				$loggedin = true;
			}
			else
			{
				echo "Invalid username/password combination";
				echo $loginform;
				echo $regform;
			}
		}
		else if($_POST['action']=='Register')
		{
			///Register Operations
			$u = new User();
			$res = $u->register($_POST['uname'], $_POST['pwd']);
			if($res)
				echo "Register Successful";
			else
				echo "User already exists";
			echo $loginform;
			echo $regform;
		}
		else
		{
			echo $loginform;
			echo $regform;
		}
	}
	else
	{
		echo $loginform;
		echo $regform;
	}
}

if($loggedin===true)
{
	$u = $_SESSION['user'];
	if(isset($_POST['action']) && $_POST['action']=="Logout")
	{
		unset($_SESSION['user']);
		$_SESSION['loggedin']=false;
		header("Location: index.php");
	}
	else if(isset($_POST['action'], $_POST['data']) && $_POST['action']=="add")
	{
		//Add data
		$info = new Info();
		$info->uid = $u->uid;
		$info->data = $_POST['data'];
		$info->insertInfo();
	}
	else if(isset($_POST['action'], $_POST['data'], $_POST['iid']) && $_POST['action']=="edit")
	{
		//Edit data
		$info = new Info();
		$info->uid = $u->uid;
		$info->data = $_POST['data'];
		$info->iid = $_POST['iid'];
		if($info->updateInfo()===false)
			echo "Something went wrong";
	}
	echo "Hello, ".$u->uname."<br/>\n";
	$infos = getAllInfo($u->uid);
	foreach($infos as $info)
	{
		//echo $info->iid.":".$info->data."<br/>\n";
		echo "<form method='POST'>\n";
		echo "<input type='textarea' value='$info->data' name='data'>\n";
		echo "<input type='hidden' value='$info->iid' name='iid'>\n";
		echo "<input type='submit' value='edit' name='action'>\n";
		echo "</form><br/>\n";
	}

	$logoutform = <<<EOF
	<form method="POST">
		<input type="submit" value="Logout" name="action">
	</form>
EOF;
	$adddata = <<<EOF
<form method="POST">
	<input type="textarea" name="data">
	<input type="submit" value="add" name="action">
</form>
EOF;
	echo $adddata;
	echo $logoutform;
}

?>

