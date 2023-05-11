 <?php
	
	include './Classes/dbh.classes.php';

	//include "Includes/login.inc.php";

	include './Classes/search.classes.php';
	include './Classes/result-contr.classes.php';

	session_start();

	if (!isset($_SESSION['userId']) )
	{
		//header('Location: ./login.php');
		//exit();
	}
	include './auth.php';
	
	include 'search.inc.php';

	include "./Classes/account.classes.php";
	include "./Classes/account-contr.classes.php";

	$canEdit = "Edit";
	$canView = "password";
	include './Includes/account.inc.php';

	include './Classes/library.classes.php';
	include 'library.inc.php';
	
	

	if ( isset($_POST['LOGIN']) )
	{

		header("location: ./login.php");
	}

	if ( isset($_POST['LOGOUT']) )
	{
		session_unset();
		session_destroy();

		header("location: ./login.php");
	}


?>