<?php
	//Class that just opens up a connection

	class DB_Manager
	{
		protected function connect()
		{
			try 
			{
				$dbhost = 'localhost'; // mySQL Hostname

				$dbuser = 'mfalana'; // mySQL Username

				$dbpass = 'A8812fal'; // mySQL Password

				$db = 'mfalana'; // Database Name
				
				$con = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);
				//echo 'Connected to database'; //echo a message saying we have connected
				echo '  ';
				return $con; //returns Database Connection
			}
			catch(PDOException $e)
			{
				print "There was an error establishing a connection to the database: ". $e->getMessage() . "<br/>";
				die(); //kills the connection
			}
		}
	}

?>
