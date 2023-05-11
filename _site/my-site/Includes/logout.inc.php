<?php

	if (isset($_POST["logout"]))
	{
//		//Grabbing the data
//		$email = $_SESSION['Email'];
//		$pwd = $_SESSION['Password'];
//		
//		//Instantiate loginContr class
//		include "./Classes/dbh.classes.php";
//		include "./Classes/login.classes.php";
//		include "./Classes/login-contr.classes.php";
//		$login = new LoginContr($email, $pwd);
//		
//		//Running error handlers and user login user
		$login->logOut();

			
	}
?>