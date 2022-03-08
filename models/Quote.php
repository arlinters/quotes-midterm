<?php
	class Quote{
		// Database Information
		private $conn;
		private $table = 'quotes';

		// Properties
		public $id;
		public $quote;
		public $authorId;
		public $categoryId;

		public function __construct(\PDO $db){
			$this->conn = $db;
		}

		// Get author
		public function getAll(){
			$query = 'SELECT
				id,
				quote,
				authorId,
				categoryId
			FROM
			'. $this->table;

			// Prepare SQL statement
			$statement = $this->conn->prepare($query);
			$statement->execute();

			return $statement;
		}

		public function getAllByAuthorIdAndCategoryId($authorId, $categoryId){
			$query = 'SELECT
			id,
			quote,
			authorId,
			categoryId
			FROM
			'. $this->table .'
			WHERE
				authorId = ? AND categoryId = ?
			';
			
			// Prepare SQL statement
			$statement = $this->conn->prepare($query);
			$statement->bindParam(1, $authorId);
			$statement->bindParam(2, $categoryId);
			$statement->execute();

			return $statement;
		}

		public function getAllByCategoryId($categoryId){
			$query = 'SELECT
			id,
			quote,
			authorId,
			categoryId
			FROM
			'. $this->table .'
			WHERE
				categoryId = ?
			';
			
			// Prepare SQL statement
			$statement = $this->conn->prepare($query);
			$statement->bindParam(1, $categoryId);
			$statement->execute();

			return $statement;
		}

		
		public function getAllByAuthorId($authorId){
			$query = 'SELECT
			id,
			quote,
			authorId,
			categoryId
			FROM
			'. $this->table .'
			WHERE
				authorId = ?
			';
			
			// Prepare SQL statement
			$statement = $this->conn->prepare($query);
			$statement->bindParam(1, $authorId);
			$statement->execute();

			return $statement;
		}

		public function getById($id){
			$query = 'SELECT
				id,
				quote,
				authorId,
				categoryId
			FROM
			'. $this->table.'
			
			WHERE id = ?
			LIMIT 0,1';

			// Prepare SQL statement
			$statement = $this->conn->prepare($query);

			$statement->bindParam(1, $id);
			$statement->execute();
			
      $row = $statement->fetch(PDO::FETCH_ASSOC);
			if($row){
				$this->id = $row['id'];
				$this->authorId = $row['authorId'];
				$this->categoryId = $row['categoryId'];
				$this->quote = $row['quote'];
			}
		}
		
		public function create(){
			// Create query
			$query = 'INSERT INTO ' . $this->table . ' SET quote = :quote, categoryId = :cId, authorId = :aId';

			// Prepare statement
			$stmt = $this->conn->prepare($query);

			// Clean data
			$this->quote = htmlspecialchars(strip_tags($this->quote));
			$this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
			$this->authorId = htmlspecialchars(strip_tags($this->authorId));

			// Bind data
			$stmt->bindParam(':quote', $this->quote);
			$stmt->bindParam(':cId', $this->categoryId);
			$stmt->bindParam(':aId', $this->authorId);

			// Execute query
			if($stmt->execute()) {
				$this->id = $this->conn->lastInsertId();
				return;
			 }
			throw new Exception('Error when inserting the author, '. $this->category .' into the database.');
	 }
	}
?>