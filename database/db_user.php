<?php
  include_once('init.php');


  function checkPassword($username, $password) {
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ? AND passw = ?');
    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT)));
    return $stmt->fetch()?true:false; // return true if a line exists
  }

  function insertUser($username, $password) {
    $date = date('Y-m-d H:i:s');
    $db = Database::getInstance()->db();
      
      $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
      
      if($stmt->fetch())
        return false;
      
  
    $stmt = $db->prepare('INSERT INTO users VALUES(?, ?, ?)');
    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT),$date));
      
      return true;
  }
?>