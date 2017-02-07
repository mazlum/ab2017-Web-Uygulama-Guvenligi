<?php

class User
{
	private $db;
	public $uname;
	public $uid;

	function __construct()
	{
		$this->db = new mysqli("localhost", "root", "", "system");
		if($this->db->connect_error)
			die($this->db->connect_error);
	}

	function checkLogin($uname, $pass)
	{
		$sql = "SELECT id,uname,salt,hash FROM users WHERE uname=?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $uname);

		$id = 0;
		$dbuname = "";
		$salt = "";
		$hash = "";

		$stmt->execute();
		$stmt->bind_result($id, $dbuname, $salt, $hash);
		if($stmt->fetch())
		{
			if(hash_hmac('sha256', $pass, $salt)===$hash)
			{
				$this->uid = $id;
				$this->uname = $dbuname;
				return true;
			}
		}
		return false;
	}

	function register($uname, $pass)
	{
		//User Existence Check
		$sql = "SELECT id FROM users WHERE uname=?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $uname);
		$id = 0;
		$stmt->execute();
		$stmt->bind_result($id);
		if($stmt->fetch())
			return false;

		//User Insertion
		$sql = "INSERT INTO users (uname,salt,hash) VALUES(?,?,?)";
		$stmt = $this->db->prepare($sql);
		$salt = uniqid("", true);
		$hash = hash_hmac('sha256', $pass, $salt);
		$stmt->bind_param("sss", $uname, $salt, $hash);
		$stmt->execute();
		return true;
	}
}


?>
