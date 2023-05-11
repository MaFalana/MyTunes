<?php
	//include "result-contr.classes.php";

	class Account extends DB_Manager
	{
		
		protected function setUser($uid, $fname, $lname, $uname, $pwd, $email) //Selects user in DB
		{
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
			
			$publisher = ['id' => $uid, 'username' => $uname, 'password' => $hashedPwd];
			
			if( !isset($_SESSION['admin']) )
			{
				$sql = 'UPDATE user SET username = :username, password = :password WHERE id = :id';
			}
			else
			{
				$sql = 'UPDATE admin SET username = :username, password = :password WHERE id = :id';
			}

			
			$stmt = $this->connect()->prepare($sql);
			
			$stmt->bindParam('id', $publisher['id'], PDO::PARAM_INT);
			
			$stmt->bindParam('username', $publisher['username']);
			
			$stmt->bindParam('password', $publisher['password']);
			
			if ($stmt->execute())
			{
				echo "Account succesfully updated";
			}
				
			$stmt = null;
			
			$_SESSION["userId"] = $uid;
			$_SESSION["FirstName"] = $fname;
			$_SESSION["LastName"] = $lname;
			$_SESSION["UserName"] = $uname;
			$_SESSION['Email'] = $email;
			$_SESSION['Password'] = $pwd;
			
			if( isset($_SESSION['admin']) )
			{
				$_SESSION['admin'] = $uname;
			}
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
				$resultCheck = false;
			}
			else
			{
				$resultCheck = true;
			}
			
			return $resultCheck;
		}

		protected function addToLibrary($result)
		{
			$stmt = $this->connect()->prepare("insert into track values(?, ?, ?, ?, ?, ?, ?)");

			$stmt->execute(array($result->id, $result->author,$result->title, $result->genre, $result->type, $result->pic, $result->id));

			$stmt = null;
		}

	}
?>