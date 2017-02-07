<?php

class Info
{
	private $db;
	public $iid;
	public $uid;
	public $data;

	function __construct()
	{
		$this->db = new mysqli("localhost", "root", "", "system");
	}

	function getInfo($id)
	{
		$sql = "SELECT uid,data FROM info WHERE id=?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->bind_result($this->uid, $this->data);
		if($stmt->fetch())
		{
			$this->data = htmlspecialchars($this->data, ENT_QUOTES);
			return true;
		}
		return false;
	}

	function insertInfo()
	{
		$sql = "INSERT INTO info(uid, data) VALUES (?,?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("is", $this->uid, $this->data);
		$stmt->execute();
		return true;
	}

	function updateInfo()
	{
		$sql = "UPDATE info SET data=? WHERE id=? AND uid=?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("sii", $this->data, $this->iid, $this->uid);
		$stmt->execute();
		if($this->db->affected_rows==0)
			return false;
		return true;
	}
}

function getAllInfo($uid)
{
	$res = array();
	$db = new mysqli("localhost", "root", "", "system");
	$sql = "SELECT id, data FROM info WHERE uid=?";
	$stmt = $db->prepare($sql);
	$stmt->bind_param("i", $uid);
	$stmt->execute();
	$id = 0;
	$data = "";
	$stmt->bind_result($id, $data);
	while($stmt->fetch())
	{
		$info = new Info();
		$info->uid = $uid;
		$info->iid = $id;
		$info->data = htmlspecialchars($data, ENT_QUOTES);
		$res[] = $info;
	}
	if(count($res)==0)
		return false;
	return $res;
}


?>
