<?php

	if (isset($_POST["register"]))
	{
		//Grabbing the data
		$uid = trim($_POST['firstName']);
		$fName = trim($_POST['firstName']);
		$lName = trim($_POST['lastName']);
		$uname = createUserName($fName,$lName);
		$email = trim($_POST['email']);
		$cemail = trim($_POST['cemail']);
		$pwd = trim($_POST['pwd']);
		$cpwd = trim($_POST['cpwd']);
		$gen = "man";//trim($_POST['gender']);
		
		//Instantiate signupContr class
		include "./Classes/dbh.classes.php";
		include "./Classes/signup.classes.php";
		include "./Classes/signup-contr.classes.php";
		$signup = new SignUpContr($uid, $fName, $lName, $uname, $email, $cemail, $pwd, $cpwd, $gen);
		
		//Running error handlers and user signup
		if( !isset($_POST['admin']) )
		{
			$signup->signupUser();
		}
		else
		{
			$signup->createAdmin();
		}
		
		//Going back to front page
		header("location: ./account.php?error=none"); //no error signing up
			
	}

	if (isset($_POST['login']))
	{
		//Going back to front page
		header("location: ./login.php"); //no error signing up
			
	}

	function createUserName(&$fName, &$lName) //creates user name using user's first and last name
	{
		$userName = mb_substr($fName,0,1); //gets first letter of last name

		$userName.=$lName; //appends last name

		$userName = strtolower($userName); //makes string lower case
		/*
		$stmt = "SELECT USER_USERNAME FROM USER WHERE USER_USERNAME LIKE '$userName'";

		$result = sql($con, $stmt);

		$stmt = $con->prepare("select USER_USERNAME from USER where USER_USERNAME = ?");

		$stmt->execute(array($userName));

		if $stmt != TRUE// if user name exists
		{
			$count = 0;
			$userName.= $count; // add a number to the end
		}
		*/
		return $userName; //newly created username
	}
?>