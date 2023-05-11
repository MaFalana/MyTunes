<?php

	//include './auth.php';
	//include 'search.inc.php';

	if ( isset($_POST['search']) )
	{
		$searchInput = trim($_POST['searchQuery']);
		$searchParameter = trim($_POST['Category']);

		$spotify->searchInput($searchInput, $searchParameter);
	}


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