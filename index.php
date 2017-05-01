<?php 
session_start();

if($_SESSION['userVars']) {
	header("Location: home.php");
}

?>



<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/login/default.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 ">	
				<div class="login">
					<img src="assets/img/spa-logo.png" alt="">
	  				<div class="login-triangle"></div>
	  
	  				<h2 class="login-header">Log in</h2>

					<form class="login-container" action="./php/login.php" method="post">
						<div class="input-group margin-bottom-sm">
						  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
						  <input name="email" class="form-control" type="email" placeholder="Email address">
						</div>
						
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
						  <input name="password" class="form-control" type="password" placeholder="Password">
						</div>
		
						<input type="submit" value="Log in">
					</form>
				</div>
			</div>
		</div>
	</div>

<script src="assets/jquery.js"></script>
<script src="assets/bootstrap/js/bootstrap.js"></script>

</body>
</html>