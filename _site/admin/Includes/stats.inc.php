<?php
	$st = new Stats();

	$st->getUsers();

	$registeredUsers = $st->list;

	if(isset($_POST['selectedUser']))
	{	
		if ($_POST['selectedUser'] != 'Gamma')
		{
			$likes = $st->Likes(trim($_POST['selectedUser']));
			$users = [$st->getAUser(trim($_POST['selectedUser']))["username"]];

			//echo json_encode($likes);
			//echo json_encode($users);
		}
		else
		{
			$likes = $st->getAllLikes();
			$users = $st->getNames();
			//echo $users;
		}

		
	}


?>