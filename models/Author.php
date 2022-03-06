<?php
	class Author{
		// Database Information
		private $conn;
		private $table = 'authors';

		// Properties
		public $id;
		public $author;

		public function __construct(\PDO $db){
			$this->conn = $db;
		}

		// Get author
		public function getAll(){
			$query = 'SELECT
				id,
				author
			FROM
			'. $this->table;

			// Prepare SQL statement
			$statement = $this->conn->prepare($query);
			$statement->execute();

			return $statement;
		}


		public function getById($id){
			$query = 'SELECT
				id,
				author
				FROM
			'. $this->table .'
			
			WHERE id = ?
			LIMIT 0,1';

			// Prepare SQL statement
			$statement = $this->conn->prepare($query);

			$statement->bindParam(1, $id);
			$statement->execute();
			
      $row = $statement->fetch(PDO::FETCH_ASSOC);
			if($row){
				$this->id = $row['id'];
				$this->author = $row['author'];
			}
		}
	}
?>