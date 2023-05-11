<?php
	session_start();
	include '../auth.php';

	include '../Classes/dbh.classes.php';
	//include_once '../app.php';
	include '../Classes/search.classes.php';
	include '../Includes/search.inc.php';	
?>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Liked Songs</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    	<link rel="stylesheet" href="../css/search.css">
	</head>

	<body>
		
		<div class="nav">
			<div class="nav-cell">
				
				  
			  <div class="nav-linkCell">
					<div class="nav-linkText">Music</div>
					<div class="nav-linkText2">Podcast</div>
					<div class="nav-linkText3">Radio</div>
					<div class="nav-linkText4">Live</div>
				</div>
				
				
					<form action="search.php" method="post">
						<input type="text" value="" name="searchQuery"  class="nav-searchCell" placeholder="Search for music..." />
						<input name="search" class="nav-searchBtn" type="submit" src="../css/assets/vector2.svg" alt="Search"/>
						<select class="nav-dropdown" name="Category"> <?php echo $searchModifiers; ?> </select>
					</form>
				
				
				
				
				<div onClick="location.href='../account.php'" class="nav-profileCell"> 
					<img class="nav-profilePic" src="../css/assets/strawhat.png" />
					<div class="nav-profileName"><?php echo $_SESSION['FirstName'].' '.$_SESSION['LastName'];?></div>
				</div>
				
			</div>
	</div>
		
		<div class="sideMenu-cell">
			<div onClick="location.href='../index.php'" class="logo-cell">
				<div class="logo-text">Mytunes</div>
				<div class="logo-background">
					<img class="logo-pic" src="../css/assets/logo.svg" />
				</div>
			</div>
			
			<div class="menu-cell">
				<div class="header">MENU</div>
				<div class="subset">
					<div class="subsetTitle">Discover</div>
					<img class="subsetIcon" src="../css/assets/discover.svg" />
				</div>
				<div class="subset">
					<div class="subsetTitle">Explorer</div>
					<img class="subsetIcon" src="../css/assets/explorer.svg" />
				</div>
				<div class="subset" onClick="location.href='../search.php'">
					<!---<div class="activePage2"></div>--->
					<div class="subsetTitle">Search</div>
					<img class="subsetIcon" src="../css/assets/search.svg" />
				</div>
			</div>
			
			<div class="menu-cell">
				<div class="header">LIBRARY</div>
				<div class="subset" onClick="location.href='likes.php'">
					<div class="subsetTitle">Liked Songs</div>
					<img class="subsetIcon" src="../css/assets/likes.svg" />
				</div>
				<div class="subset" onClick="location.href='playlists.php'">
					<div class="subsetTitle">Playlists</div>
					<img class="subsetIcon" src="../css/assets/playlists.svg" />
				</div>
				<div class="subset" onClick="location.href='following.php'">
					<div class="subsetTitle">Following</div>
					<img class="subsetIcon" src="../css/assets/following.svg" />
				</div>
				<div class="subset" onClick="location.href='history.php'">
					<div class="subsetTitle">History</div>
					<img class="subsetIcon" src="../css/assets/history.svg" />
				</div>
			</div>
			
			<div class="menu-cell">
				<div class="header">OTHER</div>
				<div class="subset" onClick="location.href='../account/settings.php'">
					<div class="subsetTitle">Settings</div>
					<img class="subsetIcon" src="../css/assets/settings.svg" />
				</div>
				<div class="subset">
					<form action="index.php" method="post">
						 <!-- <input class="subsetTitle" type="submit" name="logout" value="Logout"/> -->
						<div class="subsetTitle">Logout</div>
						<img class="subsetIcon" src="../css/assets/logout.svg" />	
					</form>
				</div>
			</div>

		</div>
		
		<div class="player-cell">
			<div class="rightMenu-cell">
				<div class="sectionList">
					<div class="sectionHeader">TOP 15 NEW RELEASES</div>
					<?php $spotify->getTopTen(); ?>
				</div>
				<img class="divider" src="../css/assets/divider.svg" />
				
				<div class="musicPlayer"> 
					<div class="musicHeader">NOW PLAYING</div>
					<image class="musicPic" src="" />
					<div class="musicTitle">Dynamite</div>
					<div class="musicAuthor">BTS</div>
				</div>
			</div>
			
		</div>
		
		<div class="searchHeader">Liked Songs</div>
		<div class="libraryDiv">
			
			<div class="libraryCell">
				<div class="libraryCounter">14 Albums</div>
			</div>
		</div>
		
		
		
	</body>
</html>