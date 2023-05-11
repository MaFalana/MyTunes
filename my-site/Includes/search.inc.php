<?php

	$spotify = new Search();

	$searchModifiers = $spotify->createSearchDropdown();

	

	if ( isset($_POST['search']) )
	{

		//header("location: ./search.php?query=$searchInput,type=$searchParameter");

		$searchInput = trim($_POST['searchQuery']);

		$searchParameter = trim($_POST['Category']);

		echo '<div class="searchHeader">Search Results</div>';

		echo '<form action="search.php" method="post" class="searchSection">';

		$spotify->searchInput($searchInput, $searchParameter);

		echo '</form>';

		//$spotify->searchResults = $_SESSION['Results'] ;
	//$spotify->likeSong($_SESSION['Results']);

	
	}	
	
?>