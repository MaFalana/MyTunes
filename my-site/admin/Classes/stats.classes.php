<?php
	class Stats extends DB_Manager
	{
		public $list = "";
		
		function showLikes()
		{
			
			for($i = 0; $i < $this->collectionTotal; $i++)
			{
				$sql = "select * from track where id = ?";
			
				$stmt = $this->connect()->prepare($sql);
			
				$stmt->execute(array($this->likedSongs[$i]['track_id']));
			
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				
				$stmt = null;
					
				echo '<div class="result-div" onclick="likeSong()">';
				echo '<div class="result-cell">';
				echo '<img name="pic" class="result-icon" src="'.$result['pic'].'"/>';
				echo '<div name="title" class="result-title">'.$result['title'].'</div>';
				echo '<div name="author" class="result-subtitle">'.$result['author'].'</div>';
				echo '<div name="type" class="result-runtime">'.$result['type'].'</div>';
				echo '<div name="id" class="result-runtime" hidden>'.$result['id'].'</div>';

				echo '<input type="submit" value="" name="like" class="'.$this->isSongLiked($result['id']).'" />';
 				echo '</div>';
				echo '</div>';

			}
		}
		
		function getUsers()
		{
			
			$sql = "select * from user"; 

			$result = $this->connect()->query($sql);
			
			$this->list = $this->list. '<option value="" disabled selected>Select an option</option>';
			
			$this->list = $this->list. '<option value = "Gamma">All</option>';

			while($row = $result->fetch(PDO::FETCH_ASSOC)) 
			{

				$this->list = $this->list. '<option value = "'.$row["id"].'" >'.$row["username"].'</option>';
			}

		}

		function getLikes($id) //Gets all songs that are liked by a certain user
		{
			$sql = "select * from likes where id = ? and isLiked = 1";

			$stmt = $this->connect()->prepare($sql);

			$stmt->execute(array($id));

			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $stmt->rowCount();

		}

		function getunLikes($id) //Gets all songs that were once liked THEN unliked by a certain user (I want to add a dislike function)
		{
			$sql = "select * from likes where id = ? and isLiked = 0";

			$stmt = $this->connect()->prepare($sql);

			$stmt->execute(array($id));

			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $stmt->rowCount();

		}
		
		function Likes($id)
		{
			$likes = array();

			$X = "";

			$Y = "";

			$sql = "select * from user where id = $id";

			$stmt = $this->connect()->prepare($sql);

			$stmt->execute();

			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			//for($i = 0; $i < $stmt->rowCount(); $i++)
			//{

				$X = $this->getLikes($id);
				$Y = $this->getunLikes($id);

				$B = array($X,$Y);
				array_push($likes,$B);

			//}

			return $likes;
		}
		
		function getAUser($id) //Gets one user
		{
			$sql = "select * from user where id = $id"; 

			$result = $this->connect()->query($sql);
			
			return $row = $result->fetch(PDO::FETCH_ASSOC);

		}
		
		function getAllLikes() //Gets all likes
		{
			$likes = array();

			$X = "";

			$Y = "";

			$sql = "select * from user";
	
			$stmt = $this->connect()->prepare($sql);
	
			$stmt->execute();
	
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			//$row = $this->list;

			for($i = 0; $i < $stmt->rowCount(); $i++)
			{

				$X = $this->getLikes($row[$i]['id']);
				$Y = $this->getunLikes($row[$i]['id']);

				$B = array($X,$Y);
				array_push($likes,$B);

			}

			return $likes;
		}
		
		function getNames()
		{
			$users = array();

			$sql = "select * from user";

			$stmt = $this->connect()->prepare($sql);

			$stmt->execute();

			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			for($i = 0; $i < $stmt->rowCount(); $i++)
			{
				$A = $row[$i]['username'];

				array_push($users,$A);

			}

			return $users;

		}

	}
?>