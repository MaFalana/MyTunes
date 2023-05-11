<?php
	class Library extends DB_Manager
	{
		public $collectionTotal = '';
		
		public $likedSongs = '';
		
		function getLikes()
		{
			$sql = "select * from likes where id = ".$_SESSION['userId']." and isLiked = 1 ";
			
			$stmt = $this->connect()->prepare($sql);
			
			$stmt->execute();
			
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			if ($row)
			{
				$this->collectionTotal = $stmt->rowCount();
			
				$this->likedSongs = $row;
			}
			
			
			
			$stmt = null;
		}
		
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
		
		function addToDB($result) //Function to add a song to DB for easier lookup and ajax stuff
		{
			$sql = "insert into track values(?, ?, ?, ?, ?, ?)";
			
			$stmt = $this->connect()->prepare($sql);
			
			$stmt->execute(array($result->id, $result->author, $result->title, $result->genre, $result->type, $result->pic));
			
			$stmt = null;
		}
		
		function findInDB($id) //Function to find a song in DB for easier lookup and ajax stuff
		{
			$sql = "select * from track where id = ?";
			
			$stmt = $this->connect()->prepare($sql);
			
			//$stmt->execute();
			
			if( !$stmt->execute(array($id)) )
			{
				$stmt = null;
				
				return 0;
			}
			
			$stmt->fetch(PDO::FETCH_ASSOC);
			
			$count = $stmt->rowCount();
			
			$stmt = null;
			
			return $count;
		}
		
		function likeASong($result) //Function to like a song
		{
			if( $this->findInDB($result->id) == 0 ) //if song not in DB
			{
				$this->addToDB($result);
				
				$sql = "insert into likes values(?, ?, ?)";
			
				$stmt = $this->connect()->prepare($sql);
			
				$stmt->execute(array($_SESSION['userId'], $result->id, 1)); //1 for a liked song, 0 for unliked
			}
			else
			{
				$sql = "update likes set isLiked = ? where id = ? and track_id = ?";
			
				$stmt = $this->connect()->prepare($sql);
				
				if ( $this->isSongLiked($result->id) == "likeBtn") //if song already liked
				{
					$stmt->execute(array(0, $_SESSION['userId'], $result->id)); //is unliked
				}
				else
				{
					$stmt->execute(array(1, $_SESSION['userId'], $result->id)); //is liked
				}
				
			}

			$stmt = null;

		}
		
		function isSongLiked($id) //Checks if song is like or not
		{
			$sql = "select * from likes where id = ? and track_id = ? and isLiked = ?";
			
			$stmt = $this->connect()->prepare($sql);
				
			$stmt->execute(array($_SESSION['userId'], $id, 1)); //if not liked
			
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($row)
			{
				if( $row['isLiked'] == 0 ) //if not liked
				{
					$stmt = null;

					return "unlikeBtn";
				}
				else
				{
					$stmt = null;
					return "likeBtn";
				}
			}
			else
			{
				$stmt = null;
				return "unlikeBtn";
			}
		}
		
	}
?>