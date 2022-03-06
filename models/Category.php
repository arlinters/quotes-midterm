<?php
	class Category{
		// Database Information
		private $conn;
		private $table = 'categories';

		// Properties
		public $id;
		public $category;

		public function __construct(\PDO $db){
			$this->conn = $db;
		}

		// Get author
		public function getAll(){
			$query = 'SELECT
				id,
				category
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
				category
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
				$this->category = $row['category'];
			}
		}
	}
?>