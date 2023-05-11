<?php
	session_start();
		
	
	$canEdit = "Edit";
	$canView = "password";
	include "Includes/account.inc.php";

	//include "Includes/main.inc.php";

?>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Account - <?php echo $_SESSION['UserName']; ?></title>
	</head>

	<body>
		<form action = "account.php" method="post">
			
			<div class = "row">
				First Name: <input type="text" value="" name="firstName" id="firstName"  placeholder="<?php echo $_SESSION['FirstName']; ?>" disabled/>
			</div>

			<div class = "row">
				Last Name: <input type="text" value="" name="lastName" id="lastName"  placeholder="<?php echo $_SESSION['LastName']; ?>" disabled/>
			</div>

			<div class = "row">
				Username: <input type="text" value="" name="user" id="user"  placeholder="<?php echo $_SESSION['UserName']; ?>" disabled />
			</div>

			<div class = "row">
				Email: <input type="text" value="" name="email" id="email"  placeholder="<?php echo $_SESSION['Email']; ?>" disabled/>
			</div>

			<div class = "row">
				Password: <input type="<?php echo $canView; ?>" value="" name="pwd" id="pwd"  placeholder="<?php echo $_SESSION['Password']; ?>" <?php echo $isDisabled; ?> />
			</div>
			
			
			<input name="<?php echo $canEdit; ?>" class="btn" type="submit" value="<?php echo $canEdit; ?>"/>

			<input name="logout" class="btn" type="submit" value="Log out"/>
	
		</form>	

		<a href='./index.php'>Home</a>
		<a href='admin/stats.php'>Statistics</a>

	</body>
</html>