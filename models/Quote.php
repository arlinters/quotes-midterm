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

		/**
		 * Dynamically filters based on what properties are set on the object.
		 */
		public function getByParameters(){
			// Initialize where clause strings if the property exists
			$idWhereClause = $this->id ? 'id = :id' : '';
			$categoryIdWhereClause = $this->categoryId ? 'categoryId = :categoryId' : '';
			$authorIdWhereClause = $this->authorId ? 'authorId = :authorId' : '';

			// If all three conditions are present
			if($idWhereClause !== '' && $categoryIdWhereClause !== '' && $authorIdWhereClause !== ''){
				$categoryIdWhereClause = ' AND '. $categoryIdWhereClause .' AND';
			}
			// if the ID and either the 2nd or 3rd option are present
			elseif(
				($idWhereClause != '' && $categoryIdWhereClause !== '') 
				xor ($idWhereClause != '' && $authorIdWhereClause !== '')
			){
				$idWhereClause = $idWhereClause . " AND";
			}
			// If only the categoryId and authorId are present
			elseif($categoryIdWhereClause !== '' && $authorIdWhereClause !== ''){
				$categoryIdWhereClause = $categoryIdWhereClause ." AND ";
			}

			$queryTemplate = 'SELECT
				id,
				quote,
				authorId,
				categoryId
			FROM
			 %s
			
			WHERE
			 %s
			 %s
			 %s
			LIMIT 0,1';

			$query = sprintf($queryTemplate, $this->table, $idWhereClause, $categoryIdWhereClause, $authorIdWhereClause);
			// Prepare SQL statement
			$statement = $this->conn->prepare($query);

			if($this->id){
				$statement->bindParam(':id', $this->id);
			}
			if($this->authorId){
				$statement->bindParam(':authorId', $this->authorId);
			}
			if($this->categoryId){
				$statement->bindParam(':categoryId', $this->categoryId);
			}
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
	 public function update(){
		// Create Query
		$query = 'UPDATE '. $this->table . '
				SET categoryId = :categoryId, quote = :quote, id = :id, authorId = :authorId
				WHERE id = :id';

		// Prepare Statement
		$stmt = $this->conn->prepare($query);

		// Clean data
		$this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
		$this->authorId = htmlspecialchars(strip_tags($this->authorId));
		$this->quote = htmlspecialchars(strip_tags($this->quote));
		$this->id = htmlspecialchars(strip_tags($this->id));

		// Bind data
		$stmt-> bindParam(':categoryId', $this->categoryId);
		$stmt-> bindParam(':quote', $this->quote);
		$stmt-> bindParam(':authorId', $this->authorId);
		$stmt-> bindParam(':id', $this->id);

		// Execute query
		try{
			$stmt->execute();
		}
		catch(Exception $e){
			throw new Exception('Error when updating this quote, '. $this->quote .', in the database.');
		}

		if($stmt->rowCount() === 0){
			throw new Exception('quote Not Found');
		};

		return;
}
	}
?>