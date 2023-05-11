<?php
	class AccountContr extends Account //class for SQL Objects
	{
		private $uid;
		private $fName;
		private $lName;
		private $uname;
		private $email;
		private $pwd;
		
		
		public function __construct($uid, $fname, $lname, $uname, $email, $pwd) //Constructor goal is to assign data to the user
		{
			$this->uid = $uid;
			$this->fname = $fname;
			$this->lname = $lname;
			$this->uname = $uname;
			$this->email = $email;
			$this->pwd = $pwd;
		}
		
		public function editUser() //edits user info
		{			
			$this->validationCheck(); //runs through all validation checks
			$this->setUser($this->uid, $this->fname, $this->lname, $this->uname, $this->pwd, $this->email);
		}
		
		private function validationCheck()
		{
			//if( $this->emptyInput() == false)
//			{
//				echo "empty input";
//				header("location: ../index.php?error=emptyInput");
//				exit();
//			}
//			
			if( $this->invalidEmail() == false)
			{
				echo "empty input";
				header("location: ../index.php?error=invalidEmail");
				exit();
			}
//			
//			if( $this->uidTakenCheck() == false)
//			{
//				echo "Username or email already exists";
//				header("location: ../index.php?error=userOremailExists");
//				exit();
//			}
		}
		
		private function emptyInput() //error handler for empty inputs returns a bool
		{
			$result;
				
			if( empty($this->fname) || empty($this->lname) || empty($this->uname) || empty($this->email) || empty($this->pwd) || empty($this->gen) )
			{
				$result = false;
			}
			else
			{
				$result = true;
			}
			
			return $result;
		}
		
		private function invalidPWDConfirmation()
		{
			
		}
		
		private function invalidEmail() //checks if email valid
		{
			$result;
			
			if( !filter_var($this->email, FILTER_VALIDATE_EMAIL))
			{
				$result = false;
			}
			else
			{
				$result = true;
			}
			
			return $result;
		}
		
		private function pwdMatch() //checks if password matches
		{
			$result;
			
			if( $this->pwd != $this->confirmPwd)
			{
				$result = false;
			}
			else
			{
				$result = true;
			}
			
			return $result;
		}
		
		private function emailMatch() //checks if email matches
		{
			$result;
			
			if( $this->email != $this->confirmEmail)
			{
				$result = false;
			}
			else
			{
				$result = true;
			}
			
			return $result;
		}
		
		private function uidTakenCheck($uname, $email) //checks if User exists
		{
			$result;
			
			if( !$this->checkUser($this->uname, $this->email) )
			{
				$result = false;
			}
			else
			{
				$result = true;
			}
			
			return $result;
		}
		
		
	}
?>