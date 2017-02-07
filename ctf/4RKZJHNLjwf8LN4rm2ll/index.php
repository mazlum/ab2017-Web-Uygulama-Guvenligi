<?php
session_start();
ob_start();

if($_GET['logout']){
	session_destroy();
	header("Refresh: 0; url=index.php");
}

if($_POST){
	$username = 'admin';
	$password = 'password';

	$user_username = $_POST['username'];
	$user_password = $_POST['password'];

	if($username == $user_username && $password == $user_password){
		$_SESSION['login'] = 'true';
	}
}

if(isset($_SESSION['login'])){
	header('1TjNNXFIz45baGs5gNZu2T5lDJ7hCQ0Wf8yKQhUJ: e1bfd762321e409cee4ac0b6e841963c');
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
			      <a class="navbar-brand" href="#">Show me your skills. </a>
			      </div>
			      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      	<?php if(isset($_SESSION['login'])){ ?>
					<ul class="nav navbar-nav navbar-right">
				        <li><a href="?logout=true">Logout</a></li>
					</ul>
					<?php } ?>
				  </div> 	
			</nav>
			<?php if(!isset($_SESSION['login'])) { ?>
				<form action='' method='POST'> 
				  <div class="form-group">
				    <label>Email address</label>
				    <input type="text" class="form-control" name='username' placeholder="username">
				  </div>
				  <div class="form-group">
				    <label>Password</label>
				    <input type="password" class="form-control" placeholder="Password" name='password'>
				  </div>
				  <button type="submit" class="btn btn-default">Submit</button>
				</form>
			<?php } else{
				echo 'hello admin';
			} ?>
		</div>	
	</div>	
</body>    
</html>
<?php 
ob_end_flush();
?>

