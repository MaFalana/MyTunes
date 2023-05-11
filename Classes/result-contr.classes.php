<?php
	class ResultContr extends Search //class for Search Result Objects
	{
		public $id; //Object id
		public $author; //string
		public $title; //string
		public $genre; //array
		public $type; // string
		public $pic; //link of picture string
	
		
		public function __construct($id, $author, $title, $genre, $type, $pic) //Constructor goal is to assign data to a search result
		{
			$this->id = $id;
			$this->author = $author;
			$this->title = $title;
			$this->genre = $genre;
			$this->type = $type;
			$this->pic = $pic;
		}
	}
?>