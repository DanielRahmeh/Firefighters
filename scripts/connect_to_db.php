<?php
// class Database {
//     private $_conn = null;
//     public function getConnection() {
//        if (!is_null($this->_conn)) {
//           return $this->_conn;
//        }
//        $this->_conn = false;
//        try {
//           $this->_conn = new PDO('mysql:host=db5014774527.hosting-data.io;dbname=dbs12275487;charset=utf8', 'dbu5421120', 'utbm2023');
//        } catch(PDOException $e) { }
//        return $this->_conn;
//     }
//  }

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