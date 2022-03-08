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
		public function create(){
			// Create query
			$query = 'INSERT INTO ' . $this->table . ' SET category = ?';

			// Prepare statement
			$stmt = $this->conn->prepare($query);

			// Clean data
			$this->category = htmlspecialchars(strip_tags($this->category));
			

			// Bind data
			$stmt->bindParam(1, $this->category);

			// Execute query
			if($stmt->execute()) {
				$this->id = $this->conn->lastInsertId();
				return;
			 }
			throw new Exception('Error when inserting the author, '. $this->category .' into the database.');
	 }
	}
?>