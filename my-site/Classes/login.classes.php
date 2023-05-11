<?php

	class Login extends DB_Manager
	{
		protected function getUser($email, $pwd) //Saves new user to DB
		{
			if(!isset($_SESSION['sa']))
			{
				$stmt = $this->connect()->prepare("select * from user where username = ? or email = ?");
			}
			else
			{
				$stmt = $this->connect()->prepare("select * from admin where username = ? or email = ?");
			}

			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if( !$stmt->execute(array($email, $email)) )
			{
				$stmt = null;
				header("location: ./index.php?error=stmtfailed");
				exit();
			}
			
			if($stmt->rowCount() == 0)
			{
				$stmt = null;
				header("location: ./index.php?error=usernotfound"); 
				exit();
			}
			
			$pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);  //fetches as an associated array
			$checkPwd = password_verify($pwd, $pwdHashed[0]['password']); //$pwdHashed[0]['USER_PASSWORD']
		
			if($checkPwd == false)
			{
				$stmt = null;
				header("location: ./index.php?error=passwordIncorrect");
				exit();
			}
			elseif( $checkPwd == true)
			{
				if(!isset($_SESSION['sa']))
				{
					$stmt = $this->connect()->prepare("select * from user where username = ? or email = ?");
				}
				else
				{
					$stmt = $this->connect()->prepare("select * from admin where username = ? or email = ?");
				}

				
				if( !$stmt->execute(array($email, $email)) )
				{
					$stmt = null;
					header("location: ./index.php?error=stmtfailed");
					exit();
				}
			
				if($stmt->rowCount() == 0)
				{
					$stmt = null;
					header("location: ./index.php?error=usernotfound"); 
					exit();
				}
				
				$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
				session_start();
				$_SESSION["userId"] = $user[0]["id"];
				$_SESSION["FirstName"] = $user[0]["first"];
				$_SESSION["LastName"] = $user[0]["last"];
				$_SESSION["UserName"] = $user[0]["username"];
				$_SESSION['Email'] = $user[0]["email"];
				$_SESSION['Password'] = $pwd;
				if(isset($_SESSION['sa']))
				{
					$_SESSION['admin1'] = $user[0]["id"];
				}

				
			}
			
			$stmt = null;
		}
		
		protected function checkUser($uname, $email) //checks if user exists in DB
		{
			$stmt = $this->connect()->prepare('SELECT id FROM user WHERE email = ? OR username = ?');
			
			if( !$stmt->execute(array($uname, $email) )) //checks if failed executing
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
		
		protected function logOut()
		{
			session_start();
			session_unset();
			session_destroy();
			
			header("location: ./login.php");
			
			echo "Thanks for logging out";
		}
	}
?>