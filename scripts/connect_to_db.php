<?php
class Database {
    private $_conn = null;
    public function getConnection() {
       if (!is_null($this->_conn)) {
          return $this->_conn;
       }
       $this->_conn = false;
       try {
          $this->_conn = new PDO('mysql:host=localhost;dbname=firefighter_db', 'root', '');
       } catch(PDOException $e) { }
       return $this->_conn;
    }
 }
?>