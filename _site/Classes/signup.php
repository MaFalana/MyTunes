<?php

	if (isset($_POST["register"]))
	{
		//Grabbing the data
		$fName = trim($_POST['firstName']);
		$lName = trim($_POST['lastName']);
		$uname = createUserName($fName,$lName);
		$email = trim($_POST['Email']);
		$cemail = trim($_POST['Confirm_Email']);
		$pwd = trim($_POST['Password']);
		$cpwd = trim($_POST['Confirm_Password']);
		$gen = trim($_POST['gender']);
		
		//Instantiate signupContr class
		include "../Classes/signup.classes.php";
		include "../Classes/signup-contr.classes.php";
		$signup = new SignUpContr('0', $fname, $lname, $uname, $email, $pwd, $gen);
		
		//Running error handlers and user signup
		
		//Going back to front page
			
	}
?>