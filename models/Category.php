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

		// Get category
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
			throw new Exception('Error when inserting the category, '. $this->category .' into the database.');
	 }
	 public function update(){
		// Create Query
		$query = 'UPDATE '. $this->table . '
				SET category = :category
				WHERE id = :id';

		// Prepare Statement
		$stmt = $this->conn->prepare($query);

		// Clean data
		$this->category = htmlspecialchars(strip_tags($this->category));
		$this->id = htmlspecialchars(strip_tags($this->id));

		// Bind data
		$stmt-> bindParam(':category', $this->category);
		$stmt-> bindParam(':id', $this->id);

		// Execute query
		try{
			$stmt->execute();
		}
		catch(Exception $e){
			throw new Exception('Error when updating this category, '. $this->category .', in the database.');
		}

		if($stmt->rowCount() === 0){
			throw new Exception('categoryId Not Found');
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
			throw new Exception('Error when updating this categoryId, '. $this->category .', in the database.');
		}

		if($statement->rowCount() === 0){
			throw new Exception('categoryId Not Found');
		};

		return;
    }
	}
?>