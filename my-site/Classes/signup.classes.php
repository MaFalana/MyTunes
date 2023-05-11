<?php

	class Signup extends DB_Manager
	{
		protected function setUser($fname, $lname, $uname, $pwd, $email) //Saves new user to DB
		{
			$stmt = $this->connect()->prepare("select id from user where id = ?");
			
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			$id = $stmt->rowCount();
			
			if( $id >= 1)
			{
				$id ++;
			}
			
			
			$stmt = $this->connect()->prepare("insert into user values(?, ?, ?, ?, ?, ?, ?)");
			
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
			
			if( !$stmt->execute(array($id, $fname, $lname, $uname, $email, $hashedPwd, $uname)) )
			{
				$stmt = null;
				header("location: ./index.php?error=stmtfailed"); //send user to front page of stmt fails
				exit();
			}
			
			$stmt = null;
			
			$_SESSION["userId"] = $id;
			$_SESSION["FirstName"] = $fname;
			$_SESSION["LastName"] = $lname;
			$_SESSION["UserName"] = $uname;
			$_SESSION['Email'] = $email;
			$_SESSION['Password'] = $pwd;

			$this->createLibrary($uname);
		}
		
		protected function setAdmin($fname, $lname, $uname, $pwd, $email) //Saves new user to DB
		{
			$stmt = $this->connect()->prepare("select id from user where id = ?");
			
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			$id = $stmt->rowCount();
			
			if( $id >= 1)
			{
				$id ++;
			}
			
			
			$stmt = $this->connect()->prepare("insert into admin values(?, ?, ?, ?, ?, ?)");
			
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
			
			if( !$stmt->execute(array($id, $fname, $lname, $uname, $email, $hashedPwd)) )
			{
				$stmt = null;
				header("location: ./index.php?error=stmtfailed"); //send user to front page of stmt fails
				exit();
			}
			
			$stmt = null;
			
			$_SESSION["userId"] = $id;
			$_SESSION["FirstName"] = $fname;
			$_SESSION["LastName"] = $lname;
			$_SESSION["UserName"] = $uname;
			$_SESSION['Email'] = $email;
			$_SESSION['Password'] = $pwd;

			//$this->createLibrary($uname);
		}
		
		public function createLibrary($uname)
		{
			//$sql = "insert into library values(?, ?, ?, ?)";
			
			$stmt = $this->connect()->prepare("insert into library values(?, ?, ?, ?)");

			$stmt->execute(array($uname,1,$uname,$uname));

			$stmt = null;
		}

		protected function checkUser($uname, $email) //checks if user exists in DB
		{
			$stmt = $this->connect()->prepare("select id from user where email = ? or username = ?");
			
			if( !$stmt->execute(array($uname, $emai) )) //checks if failed executing
			{
				$stmt = null;
				header("location: ./index.php?error=stmtfailed"); //send user to front page of stmt fails
				exit();
			}
			
			$resultCheck;
			
			if($stmt->rowCount() > 0) //checks results
			{
				$resultCheck = false; //User already exists
			}
			else
			{
				$resultCheck = true; //User does not exist
			}
			
			return $resultCheck;
		}
	}
?>