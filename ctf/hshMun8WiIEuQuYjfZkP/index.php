<?php
	$filename_list = array('');

	$command_array = array("ls", "zip");
	if($_POST){
		$command = $_POST['command'];
		if(strlen($command) > 5){
			$output = "too long";
                }else{
		$command_name = explode(" ", $command)[0];
		if(!in_array($command_name, $command_array)){
			$output = "command not found";
		}else{
			if(isset($command)){
				$output = shell_exec($command);
			}
		}}
	}
?>

<html>
<head>
	<script type='text/javascript' src='js/bootstrap.min.js'></script>
	<link rel='stylesheet' href='css/bootstrap.min.css' />
</head>
<body>
	<div class='container'>
		<div class='swrow'>
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#">Wellcome </a>
			      </div>	
			</nav>
			
			<form action='' method='POST'> 
			  <div class="form-group">
			    <label>Command</label>
			    <input type="text" class="form-control" name='command' placeholder="command">
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
			<?php 
				if(isset($output)){
					echo $output;
				}
			?>

		</div>	
	</div>	
</body>    
</html>


