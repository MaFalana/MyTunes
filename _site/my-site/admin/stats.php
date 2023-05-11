<?php
	session_start();
	include "../Classes/dbh.classes.php";
	include "Classes/stats.classes.php";
	include "Includes/stats.inc.php";
?>
<html>
	<head>
	<meta charset="UTF-8">
	<script type="text/javascript" src="Includes/Libraries/RGraph.common.core.js" ></script>
   	<script type="text/javascript" src="Includes/Libraries/RGraph.bar.js" ></script>
   	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<title>Statistics</title>
	</head>

	<body>

		<form action="stats.php" method="post">
			<!-- <input type="text" value="" name="searchQuery"  class="nav-searchCell" placeholder="Search for music..." /> -->
			<!-- <input name="search" value="" class="nav-searchBtn" type="submit" alt="Search"/>  -->
			<select class="nav-dropdown" name="selectedUser" onchange='this.form.submit()'> <?php echo $registeredUsers; ?> </select>
			<noscript><input type="submit" value="Submit"></noscript>
		</form>

	<canvas id="cvs" width="500" height="250">[No canvas support]</canvas>
	
	
	<script>
        $(document).ready(function ()
        {	
			var data = <?php echo json_encode($likes); ?>;
			var users = <?php echo json_encode($users); ?>;
			
           	var bar4 = new RGraph.Bar('cvs', data)
                .set('colors', ['#4343EE', '#9943EE']) // #9943EE #EEEE43
                .set('labels', users)
                .set('numyticks', 5)
				.set('ymax', 30)
                .set('ylabels.count', 5)
                .set('gutter.left', 35)
                .set('variant', '3d')
                .set('strokestyle', 'transparent')
                .set('hmargin.grouped', 0)
                .set('scale.round', true)
				.set('labels.above', true)
                .draw();
        })
    </script>


		<a href='../account.php'>Account</a>	

	</body>
</html>