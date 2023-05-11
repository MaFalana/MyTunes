<?php
	class LoginContr extends Login //class for SQL Objects
	{
		private $email;
		private $pwd;

		public function __construct($email, $pwd) //Constructor goal is to assign data to the user
		{
			$this->email = $email;
			$this->pwd = $pwd;
		}
		
		public function loginUser() //signs up user
		{
			if( $this->emptyInput() == false)
			{
				echo "empty input";
				header("location: ./index.php?error=emptyInput");
				exit();
			}
			
			$this->getUser($this->email, $this->pwd); //only need two parameters
		}
		
		
		public function logoutUser() //signs up user
		{
		
			$this->logOut($this->email, $this->pwd); //only need two parameters
		}
		
		private function emptyInput() //error handler for empty inputs returns a bool
		{
			$result;
				
			if( empty($this->email) || empty($this->pwd) )
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