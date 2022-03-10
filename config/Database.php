<?php 
  class Database {
    // DB Params
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    /**
     * Map the DB parameters to environment variables if they exist. Otherwise use dev defaults.
     */
    public function __construct()
    {   
      $this->host = getenv('DB_HOST') ?: 'localhost';
      $this->db_name = getenv('DB_NAME') ?: 'quotesdb';
      $this->username = getenv('DB_USERNAME') ?: 'root';
      $this->password = getenv('DB_PASSWORD') ?: '';
      
    }
    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password, [PDO::MYSQL_ATTR_FOUND_ROWS => true]);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }