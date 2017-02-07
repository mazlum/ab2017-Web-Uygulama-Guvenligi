<?php
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
$blacklist = <<<EOF
select
/
*
EOF;
$data = "";
foreach($_REQUEST as $val => $key)
	$data.=$val.":".$key."-";
$data = strtolower($data);
$blacklist = explode("\n", $blacklist);
foreach($blacklist as $key)
	if(strstr($data, $key)!==FALSE)
		die("Your request has been denied");

function setup($db)
{
	$flag = "prodaft_{test}";
	$tbl = "DROP TABLE IF EXISTS `flag`";
	$db->query($tbl);
	$tbl = "DROP TABLE IF EXISTS `index`";
	$db->query($tbl);
	$tbl = "CREATE TABLE `index` (id int not null auto_increment, text varchar(255), primary key(id))";
	$db->query($tbl);
	$tbl = "CREATE TABLE flag (id int not null auto_increment, text varchar(255), primary key(id))";
	$db->query($tbl);
	$ins = "INSERT INTO flag (text) VALUES ('$flag')";
	$db->query($ins);
	$text=<<<EOF
logo
Solutions
Platforms
Partners
Company
Contact Us

cyberintelligence
CYBER INTELLIGENCE
Actionable intelligence for government entities and private organizations.

 prevent_terorism
Monitoring Suspicious Behaviour
Identifying the perpetrators with predictive offender profiling.

 proactive
PROACTIVE CYBER ATTACK NOTIFICATIONS
Timely and effective warnings about discovered vulnerabilities and upcoming/expected cyber attack campaigns.

1
2
3
Predictive Offender Profiling

PRODAFT notifies clients about possible attacks that may be targeted on them on a real-time basis by analyzing TTPs of actors continuously.
Suspicious IP Tracking

Our real-time "Suspicious IP Tracking Service" provides a detailed behavior pattern analysis of any IP address which is thought to be suspicious.
Locate criminals and intercept their communication

Tracking criminals relies on the application of technical observation and surveillance. PRODAFT uses state-of-the art methodology to intercept and locate criminal activity.
Q1/2016 Technical Reports
 Cyberwarfare Capabilities Of The Countries - 2016
This report contains a detailed description of the most famous hacking groups for each country. Personal information and technical capability of the members are also included in the report.

Request Access Now
 Wikileaks Uncovered
This report contains technical information about the WikiLeaks project, owners, and whistleblowers IP addresses.

Request Access Now
 Cyber Capabilities Of Terrorist Groups.
This report contains a comprehensive study on cyber capabilities of most popular terrorist groups.

Request Access Now
Advanced Defense & Intelligence Solutions

Having an extensive knowledge in the field of information security and proactive intelligence, PRODAFT provides niche solutions for intelligence and law enforcement agencies throughout the world.
Cyber Weapon Click to see more
Proactive Defense Against Future Threats
Raven Click to see more
Actionable Intelligence Through Deep-Web Sensors(Raven®)
Child Porn Click to see more
Child Pornography Sensors on Clearweb and Deepweb
Defining the borders of Cyber Intelligence
 
Y-Parc, rue Galilée 7, 
1400 Yverdon-les-Bains, 
Switzerland
info@prodaft.com
+41 22 575 38 53
Prodaft Security Consulting and Intelligence Services LLC
EOF;
	$text = explode("\n", $text);
	foreach($text as $data)
	{
		$ins = "INSERT INTO `index` (text) VALUES ('$data')";
		$db->query($ins);
	}
}

if(isset($_GET['needle'], $_GET['cat']))
{
	$needle=$_GET['needle'];
	$cat = $_GET['cat'];
	$sql = "SELECT text FROM `index` WHERE text LIKE '%$needle$cat%'";
	$db = new mysqli('localhost', 'root', '', 'ab2016');
	//setup($db);
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
}
?>
<form method="GET">
Search text: <input type='textbox' name='needle'/><br/>
Category: <select name="cat"><option value="pro">Pro</option><option value="parc">Parc</option></select><br/>
<input type='submit' value='Search'/>
</form>
