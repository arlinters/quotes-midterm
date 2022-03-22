<?php
 include_once('Author.php');
 include_once('Category.php');
	class Quote{
		// Database Information
		private $conn;
		private $table = 'quotes';

		// Properties
		public $id;
		public $quote;
		public $author;
		public $category;

		public function __construct(\PDO $db){
			$this->conn = $db;
			$this->author = new Author($db);
			$this->category = new Category($db);
		}

		// Get author
		public function getAll(){
			$query = 'SELECT
			quotes.id id,
			quote,
			authors.id authorId,
			author,
			categories.id categoryId,
			category
			FROM
			'. $this->table.'
			LEFT JOIN categories ON quotes.categoryId = categories.id
			LEFT JOIN authors ON quotes.authorId = authors.id		
			';
			// Prepare SQL statement
			$statement = $this->conn->prepare($query);
			$statement->execute();

			return $statement;
		}

		public function getAllByAuthorIdAndCategoryId($authorId, $categoryId){
			$query = 'SELECT
				quotes.id id,
				quote,
				authors.id authorId,
				author,
				categories.id categoryId,
				category
			FROM
			 '.$this->table.'
			 LEFT JOIN categories ON quotes.categoryId = categories.id
			 LEFT JOIN authors ON quotes.authorId = authors.id			 
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
				quotes.id id,
				quote,
				authors.id authorId,
				author,
				categories.id categoryId,
				category
			FROM
			 '.$this->table.'
			 LEFT JOIN categories ON quotes.categoryId = categories.id
			 LEFT JOIN authors ON quotes.authorId = authors.id			 
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
				quotes.id id,
				quote,
				authors.id authorId,
				author,
				categories.id categoryId,
				category
			FROM
			 '.$this->table.'
			 LEFT JOIN categories ON quotes.categoryId = categories.id
			 LEFT JOIN authors ON quotes.authorId = authors.id			 
			WHERE
				authorId = ?
			';
			
			// Prepare SQL statement
			$statement = $this->conn->prepare($query);
			$statement->bindParam(1, $authorId);
			$statement->execute();

			return $statement;
		}

		public function getByQuoteId(){

			$query = 'SELECT
				quotes.id id,
				quote,
				authors.id authorId,
				author,
				categories.id categoryId,
				category
			FROM
			 '.$this->table.'
			 LEFT JOIN categories ON quotes.categoryId = categories.id
			 LEFT JOIN authors ON quotes.authorId = authors.id			 
			
			WHERE
				quotes.id = :id
			';

			// Prepare SQL statement
			$statement = $this->conn->prepare($query);

			$statement->bindParam(':id', $this->id);
			
			$statement->execute();
			
      $row = $statement->fetch(PDO::FETCH_ASSOC);
			if($row){
				$this->id = $row['id'];
				$this->author->author = $row['author'];
				$this->author->id = $row['authorId'];
				$this->category->id = $row['categoryId'];
				$this->category->category = $row['category'];
				$this->quote = $row['quote'];
			}
		}
		
		public function create($authorId, $categoryId){
			// Create query
			$query = 'INSERT INTO ' . $this->table . ' SET quote = :quote, categoryId = :cId, authorId = :aId';

			// Prepare statement
			$stmt = $this->conn->prepare($query);

			// Clean data
			$this->quote = htmlspecialchars(strip_tags($this->quote));
			$this->category->id = htmlspecialchars(strip_tags($categoryId));
			$this->author->id = htmlspecialchars(strip_tags($authorId));

			// Bind data
			$stmt->bindParam(':quote', $this->quote);
			$stmt->bindParam(':cId', $this->category->id);
			$stmt->bindParam(':aId', $this->author->id);

			// Execute query
			try{
				$stmt->execute();
				$this->id = $this->conn->lastInsertId();
			}
			catch(PDOException $e){
				if(str_contains($e->getMessage(), "authorId")){
					throw new Exception("authorId Not Found");
				}
				elseif (str_contains($e->getMessage(), "categoryId")) {
					throw new Exception("categoryId Not Found");
				}
				throw new Exception('Error when inserting the quote, '. $this->quote .' into the database.');
			}
	 }
	 public function update($authorId, $categoryId){
		// Create Query
		$query = 'UPDATE '. $this->table . '
				SET categoryId = :categoryId, quote = :quote, id = :id, authorId = :authorId
				WHERE id = :id';

		// Prepare Statement
		$stmt = $this->conn->prepare($query);

		// Clean data
		$this->category->id = htmlspecialchars(strip_tags($categoryId));
		$this->author->id = htmlspecialchars(strip_tags($authorId));
		$this->quote = htmlspecialchars(strip_tags($this->quote));
		$this->id = htmlspecialchars(strip_tags($this->id));

		// Bind data
		$stmt-> bindParam(':categoryId', $this->category->id);
		$stmt-> bindParam(':quote', $this->quote);
		$stmt-> bindParam(':authorId', $this->author->id);
		$stmt-> bindParam(':id', $this->id);

		// Execute query
		try{
			$stmt->execute();
		}
		catch(PDOException $e){
			if(str_contains($e->getMessage(), "authorId")){
				throw new Exception("authorId Not Found");
			}
			elseif (str_contains($e->getMessage(), "categoryId")) {
				throw new Exception("categoryId Not Found");
			}
			throw new Exception("An unexpected error has occurred.");
		}

		if($stmt->rowCount() === 0){
			throw new Exception('No Quotes Found');
		};

		return;
}
public function delete() {
	$query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

	$statement = $this->conn->prepare($query);

	// clean data
	$this->id = htmlspecialchars(strip_tags($this->id));

	// Bind Data
	$statement-> bindParam(':id', $this->id);


	try{
		$statement->execute();
	}
	catch(Exception $e){
		throw new Exception('Error when removing this quote Id, '. $this->id .', in the database.');
	}

	if($statement->rowCount() === 0){
		throw new Exception('No Quotes Found');
	};

	return;
	}
	}
?>