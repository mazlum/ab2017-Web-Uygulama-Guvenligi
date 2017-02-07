<?php

$form = <<<EOL
<form method="post">
	<label for="lg_url" class="sr-only">URL</label>
	<input type="text" class="form-control" id="lg_url" name="url" placeholder="URL">
	<input type="submit" value="fetch">
</form>
EOL;
echo $form;

if(isset($_POST['url']))
{
	$url = strtolower($_POST['url']);
	$banned = array("facebook","twitter");
	foreach($banned as $val)
		if(strpos($url, $val)!==false)
			die("The requested url is prohibited.");

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$resp = curl_exec($ch);
	curl_close($ch);
	echo "<code>$resp</code>\n";
}
?>

