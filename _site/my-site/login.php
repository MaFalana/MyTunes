<?php
	session_start(); //Starts the session so the variables are saved inside the session
	include "Includes/login.inc.php";

	//include "Includes/main.inc.php";
?>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="css/login.css">
</head>
	<body>
		<div class="center">
			<h1>Login</h1>
			<form action = "login.php" method="post">
				<div class="txt_field">
					<input type="text" name="email" required>
					<span></span><label>Username or Email</label>
				</div>
				<div class="txt_field">
					<input type="password" name="pwd" required>
					<span></span><label>Password</label>
				</div>
				
				<input type="checkbox" name="admin">
				<label for="admin">Admin</label><br><br>
				
				<input type="submit" name="login" value="Login">
				<div class="signup_link"> Don't have an account? <a href="register.php">Sign Up</a></div>
			</form>
		</div>
	</body>
</html>
