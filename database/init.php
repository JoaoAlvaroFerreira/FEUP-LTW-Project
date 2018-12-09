<?php
  class Database {
    private static $instance = NULL;
    private $db = NULL;
    
    
    private function __construct() {
      $this->db = new PDO('sqlite:../database/database.db');
      $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->query('PRAGMA foreign_keys = ON');
      if (NULL == $this->db)
        throw new Exception("Failed to open database");
    }
      
     

    public function db() {
      return $this->db;
    }
    

    static function getInstance() {
      if (NULL == self::$instance) {
        self::$instance = new Database();
      }
      return self::$instance;
    }
  }
?>