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
	}
?>