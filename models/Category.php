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
		public function get(){
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
	}
?>