<?php

	class Search extends DB_Manager
	{
		public $searchResults = array();
		
		public function createSearchDropdown()
		{ 
			$list = "";

			$sql = "select type from search_type"; 

			$result = $this->connect()->query($sql);

			while($row = $result->fetch(PDO::FETCH_ASSOC)) 
			{

				$list = $list. '<option value = "'.$row["type"].'">'.$row["type"].'</option>';
			}


			return $list;
		}
		
		public function searchInput($searchInput, $searchParameter)
		{
			include './app.php';
			//include "result-contr.classes.php";
			
			$response = $api->search($searchInput, $searchParameter);
			
			
			if($searchParameter == 'album')
			{
				$this->searchAlbum($response);
			}
			elseif($searchParameter == 'artist')
			{
				$this->searchArtist($response);
			}
			elseif($searchParameter == 'playlist')
			{
				$this->searchPlaylist($response);
			}
			else
			{
				$this->searchTrack($response);
			}
			
			//print_r($response);
			//$this->showResults();
			
			
			
		}
		
		public function searchAlbum($response)
		{
			//include "result-contr.classes.php";
			//$result = $response->artists;
			$total = $response->albums->total; //total number of search results
			if ($total > 20)
			{
				$total = 20;
			}
			
			for ($i = 0; $i < $total; $i++)
			{
				$id = $response->albums->items[$i]->id;
				$title = $response->albums->items[$i]->name;
				$author = $response->albums->items[$i]->artists[0]->name;
				//$genre = $response->albums->items[$i]->genres; // this is an array of strings
				$type = $response->albums->items[$i]->type; // type is single
				$pic = $response->albums->items[$i]->images[0]->url; // url link of album picture 
				//$link = $response->artists->href;
				
				$result = new ResultContr($id,$author,$title,'',$type,$pic); //Doing author name twice until ithink of an effienct way to store
				
				array_push($this->searchResults,$result);

				echo '<div class="result-div" onclick="likeSong()">';
				echo '<div class="result-cell">';
				echo '<img name="pic" class="result-icon" src="'.$result->pic.'"/>';
				echo '<div name="title" class="result-title">'.$result->title.'</div>';
				echo '<div name="author" class="result-subtitle">'.$result->author.'</div>';
				echo '<div name="type" class="result-runtime">'.$result->type.'</div>';
				echo '<div name="id" class="result-runtime" hidden>'.$result->id.'</div>';

				echo '<input type="text" name="Item[]" value="Item '.$i.'" hidden/>';

				echo '<input type="submit" value="" name="like" class="'.$this->isSongLiked($result->id).'" />';
 				echo '</div>';
				echo '</div>';

			}
			
			$_SESSION['Results'] = $this->searchResults;
		}
		
		public function searchArtist($response)
		{
			//include "result-contr.classes.php";
			//$result = $response->artists;
			$total = $response->artists->total; //total number of search results
			
			if ($total > 20)
			{
				$total = 20;
			}
			
			for ($i = 0; $i < $total; $i++)
			{
				$id = $response->artists->items[$i]->id;
				$author = $response->artists->items[$i]->name;
				$genre = $response->artists->items[$i]->genres; // this is an array of strings
				$type = $response->artists->items[$i]->type; // type is artist
				$pic = $response->artists->items[$i]->images[0]->url; // url link of artist picture 
				//$link = $response->artists->href;
				
				$result = new ResultContr($id,$author,$author,$genre,$type,$pic); //Doing author name twice until ithink of an effienct way to store
				
				//print_r($result);
				
				//$result = (array) $result;
				
				//array_push($this->searchResults,$result); //appends object to array
				echo '<div class="result-div">';
				echo '<div class="result-cell">';
				echo '<img class="result-icon" src="'.$result->pic.'"/>';
				echo '<div class="result-title">'.$result->title.'</div>';
				echo '<div class="result-subtitle">'.$result->author.'</div>';
				echo '<div class="result-runtime">'.$result->type.'</div>';
				echo '</div>';
				echo '</div>';
			}
			
			
			//print_r($result);
			///echo "Artist name is ".$name;
			
			

		}
		
		protected function searchPlaylist($response)
		{
			$total = $response->playlists->total; //total number of search results
			
			if ($total > 20)
			{
				$total = 20;
			}
			
			for ($i = 0; $i < $total; $i++)
			{
				$id = $response->playlists->items[$i]->id;
				$author = $response->playlists->items[$i]->owner->display_name;
				$title = $response->playlists->items[$i]->name;
				//$genre = $response->tracks->items[$i]->album->genres; // this is an array of strings
				$type = $response->playlists->items[$i]->type; // type is artist
				$pic = $response->playlists->items[$i]->images[0]->url; // url link of artist picture 
				//$link = $response->artists->href;
				
				$result = new ResultContr($id,$author,$title,'',$type,$pic); //Doing author name twice until ithink of an effienct way to store
				
				//print_r($result);
				
				//$result = (array) $result;
				
				//array_push($this->searchResults,$result); //appends object to array
				echo '<div class="result-div" name="'.$result->id.'">';
				echo '<div class="result-cell">';
				echo '<img class="result-icon" src="'.$result->pic.'"/>';
				echo '<div class="result-title">'.$result->title.'</div>';
				echo '<div class="result-subtitle">'.$result->author.'</div>';
				echo '<div class="result-runtime">'.$result->type.'</div>';
				echo '</div>';
				echo '</div>';
			}
		}
		
		protected function searchTrack($response)
		{
			$total = $response->tracks->total; //total number of search results
			
			if ($total > 20)
			{
				$total = 20;
			}
			
			//print_r($result);
			for ($i = 0; $i < $total; $i++)
			{
				$id = $response->tracks->items[$i]->album->id;
				$author = $response->tracks->items[$i]->artists[0]->name;
				$title = $response->tracks->items[$i]->album->name;
				//$genre = $response->tracks->items[$i]->album->genres; // this is an array of strings
				$type = $response->tracks->items[$i]->album->album_type; // type is artist
				$pic = $response->tracks->items[$i]->album->images[0]->url; // url link of artist picture 
				//$link = $response->artists->href;
				
				$result = new ResultContr($id,$author,$title,'sam',$type,$pic); //Doing author name twice until ithink of an effienct way to store
				
				array_push($this->searchResults,$result);
				//print_r($result);
				
				//$X = json_encode($result);
				
				//array_push($this->searchResults,$result); //appends object to array
				echo '<div class="result-div" onclick="likeSong()">';
				echo '<div class="result-cell">';
				echo '<img name="pic" class="result-icon" src="'.$result->pic.'"/>';
				echo '<div name="title" class="result-title">'.$result->title.'</div>';
				echo '<div name="author" class="result-subtitle">'.$result->author.'</div>';
				echo '<div name="type" class="result-runtime">'.$result->type.'</div>';
				echo '<div name="id" class="result-runtime" hidden>'.$result->id.'</div>';

				echo '<input type="text" name="Item[]" value="Item '.$i.'" hidden/>';

				echo '<input type="submit" value="" name="like" class="'.$this->isSongLiked($result->id).'" />';
 				echo '</div>';
				echo '</div>';

			}
			
			$_SESSION['Results'] = $this->searchResults;
			
		}
		
		public function showResults($result)
		{
//			$max = count($this->searchResults);
//			
//			for ($i = 0; $i <= $max; $i++)
//			{
//				echo '<div class="result-img class="result-icon" src="'.$this->searchResults[$i]->pic.'"/>';
//				echo '<div class="result-title">Anyone</div>';
//				echo '<div class="result-subtitle">'.$this->searchResults[$i]->author.'</div>';
//				echo '<div class="result-runtime">3:22</div>';
//				echo '</div>';
//			}
			//echo $result;
				echo '<div class="result-div" name="'.$result->id.'">';
				echo '<div class="result-cell">';
				echo '<img class="result-icon" src="'.$result->pic.'"/>';
				echo '<div class="result-title">'.$result->title.'</div>';
				echo '<div class="result-subtitle">'.$result->author.'</div>';
				echo '<div class="result-runtime">3:22</div>';
				echo '</div>';
				echo '</div>';
		}
		
		public function getTopTen()
		{
			include './app.php'; 
			
			$json = $api->getNewReleases(['limit' => 15]); //gets 15 new releases
			
			$total = $json->albums->limit;
			
			//$this->searchAlbum($json);
			
			//$x = $this->searchResults;
			
			for ($count = 1, $i = 0; $i < $total; $i++)
			{
				
				$id = $json->albums->items[$i]->id;
				$author = $json->albums->items[$i]->artists[0]->name;
				$title = $json->albums->items[$i]->name; // this is an array of strings
				$type = $json->albums->items[$i]->type; // type is single
				$pic = $json->albums->items[$i]->images[0]->url; // url link of album picture 
				
				$url = $json->albums->items[$i]->artists[0]->external_urls->spotify;
				
				echo '<div class="section" onClick="window.open('.$url.', mywindow)">';
				if ($count >= 10 )
				{
					echo '<div class="sectionRanking">'.$count.'</div>';
				}
				else
				{
					echo '<div class="sectionRanking">0'.$count.'</div>';
				}
				echo '<image class="sectionIcon" src="'.$pic.'"/>';
				echo '<div class="sectionName">';
				echo '<div class="sectionTitle">'.$title.'</div>';
				echo '<div class="sectionArtist">'.$author.'</div>';
				echo '</div>';
				echo '</div>';
				$count++;
			}
			
		}

		function isSongLiked($id) //Checks if song is like or not
		{
			$sql = "select * from likes where id = ? and track_id = ?";

			$stmt = $this->connect()->prepare($sql);
			
			$stmt->execute(array($_SESSION['userId'], $id));
		   
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

			
			
			//return "likeBtn";
		}
	}
?>