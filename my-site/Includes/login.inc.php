<?php

	if (isset($_POST["login"]))
	{
		//Grabbing the data
		$email = trim($_POST['email']);
		$pwd = trim($_POST['pwd']);
		
		//Instantiate loginContr class
		include "./Classes/dbh.classes.php";
		include "./Classes/login.classes.php";
		include "./Classes/login-contr.classes.php";
		$login = new LoginContr($email, $pwd);
		
		//Running error handlers and user login user
		if(isset($_POST['admin']))
		{
			$_SESSION['sa'] = $_POST['admin'];
			
		}
		$login->loginUser();
		
		//Going back to front page
		header("location: ./index.php?error=none"); //no error signing up
			
	}

	if (isset($_POST["signup"]))
	{
		//Going back to front page
		header("location: ./register.php"); //no error signing up
			
	}
?>