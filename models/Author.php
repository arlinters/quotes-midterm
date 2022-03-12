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

		public function create(){
			 // Create query
			 $query = 'INSERT INTO ' . $this->table . ' SET author = ?';

			 // Prepare statement
			 $statement = $this->conn->prepare($query);

			 // Clean data
			 $this->author = htmlspecialchars(strip_tags($this->author));
			 

			 // Bind data
			 $statement->bindParam(1, $this->author);

			 // Execute query
			 if($statement->execute()) {
				 $this->id = $this->conn->lastInsertId();
				 return;
				}
	 		throw new Exception('Error when inserting the author, '. $this->author .' into the database.');
		}


		public function update(){
			// Create Query
			$query = 'UPDATE '. $this->table . '
					SET author = :author
					WHERE id = :id';

			// Prepare Statement
			$statement = $this->conn->prepare($query);

			// Clean data
			$this->author = htmlspecialchars(strip_tags($this->author));
			$this->id = htmlspecialchars(strip_tags($this->id));

			// Bind data
			$statement-> bindParam(':author', $this->author);
			$statement-> bindParam(':id', $this->id);

			// Execute query
				try{
					$statement->execute();
				}
				catch(Exception $e){
					throw new Exception('Error when updating this author, '. $this->author .', in the database.');
				}

				if($statement->rowCount() === 0){
					throw new Exception('authorId Not Found');
				};

				return;
				

  }

  public function delete() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    $statement = $this->conn->prepare($query);

    // clean data
    $this->id = (int)htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $statement-> bindParam(':id', $this->id);


		try{
			$statement->execute();
		}
		catch(Exception $e){
			throw new Exception('Error when updating this author, '. $this->author .', in the database.');
		}

		if($statement->rowCount() === 0){
			throw new Exception('authorId Not Found');
		};

		return;
    }
}
