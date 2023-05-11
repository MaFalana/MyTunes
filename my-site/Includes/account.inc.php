<?php
echo $_SESSION['userId'];

	if (isset($_POST['Edit']))
	{
		$isDisabled = "";
		$fName = $_SESSION['FirstName'];
		$lName = $_SESSION['LastName'];
		$uname = $_SESSION['UserName'];
		$email = $_SESSION['Email'];
		$pwd = $_SESSION['Password'];
		$canEdit = "Confirm";
		$canView = "text";
	}
	else
	{
		$isDisabled = "disabled";
	}


	if (isset($_POST['Confirm']))
	{
		$canEdit = "Edit";
		$canView = "password";
		$isDisabled = "";
		//Grabbing the data
		if($_SESSION['userId'] != 'admin')
		{
			$uid = $_SESSION["userId"];
		}
		else
		{
			$uid = 'admin';
		}
		$fName = $_SESSION['FirstName'];
		$lName = $_SESSION['LastName'];
		$uname = $_SESSION['UserName'];
		
		$email = $_SESSION['Email'];
		
		if($_POST['pwd'] != "")
		{
			$pwd = trim($_POST['pwd']);
		}
		else
		{
			$pwd = $_SESSION['Password'];
		}
		
		//Instantiate AccountContr class
		include "./Classes/dbh.classes.php";
		include "./Classes/account.classes.php";
		include "./Classes/account-contr.classes.php";
		$edit = new AccountContr($uid, $fName, $lName, $uname, $email, $pwd);
		
		
		$edit->editUser(); //Running error handlers and user signup
		
		
		header("location: ./account.php"); //Going back to front page if no error editing
	}

	if ( isset($_POST['logout']) )
	{
		session_unset();
		session_destroy();

		header("location: ./login.php");

		echo "Thanks for logging out";
	}

?>