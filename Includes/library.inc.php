<?php
	//include 'main.inc.php';

	$lib = new Library();

	if( !isset($_SESSION['sa']) )
	{
		$lib->getLikes();

		$collectionTotal = $lib->collectionTotal;
	}


?>