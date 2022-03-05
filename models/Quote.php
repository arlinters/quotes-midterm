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
		public function get(){
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
	}
?>