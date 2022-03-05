<?php
	class Author{
		// Database Information
		private $conn;
		private $table = 'authors';

		// Properties
		public $id;
		public $name;

		public function __construct(\PDO $db){
			$this->conn = $db;
		}

		// Get author
		public function get(){
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
	}
?>