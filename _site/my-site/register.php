<?php
	session_start(); //Starts the session so the variables are saved inside the session
	include "Includes/signup.inc.php";
?>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="css/login.css">
</head>
	
	<body>
		<div class="center">
			<h1>Register</h1>
			<form action = "register.php" method="post">
				
				<div class="txt_field">
					<input type="text" name="firstName" required>
					<span></span><label>First Name</label>
				</div>
				
				<div class="txt_field">
					<input type="text" name="lastName" required>
					<span></span><label>Last Name</label>
				</div>
				
				<div class="txt_field">
					<input type="text" name="email" required>
					<span></span><label>Email</label>
				</div>
				
				<div class="txt_field">
					<input type="text" name="cemail" required>
					<span></span><label>Confirm Email</label>
				</div>
				
				<div class="txt_field">
					<input type="text" name="pwd" required>
					<span></span><label>Password</label>
				</div>
				
				<div class="txt_field">
					<input type="text" name="cpwd" required>
					<span></span><label>Confirm Password</label>
				</div>
				
				<input type="checkbox" name="admin">
				<label for="admin">Admin</label><br><br>
				
				<input type="submit" name="register" value="Sign Up">
				
				<div class="signup_link"> Already have an account? <a href="login.php">Login</a></div>
			</form>
		</div>
	</body>
	
</html>