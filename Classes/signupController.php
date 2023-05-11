<?php
	class SignUpContr //class for SQL Objects
	{
		private $uid; //User id
		private $fname;
		private $lname;
		private $uname;
		private $email;
		private $cemail;
		private $pwd;
		private $cpwd;
		private $gen;
		
		
		public function __construct($uid, $fname, $lname, $uname, $email, $pwd, $gen) //Constructor goal is to assign data to the user
		{
			$this->uid = $uid;
			$this->fname = $fname;
			$this->lname = $lname;
			$this->uname = $uname;
			$this->email = $email;
			$this->pwd = $pwd;
			$this->gen = $gen;
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
	}
?>