<?php
  include_once('init.php');


  function checkPassword($username, $password) {
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();
    return password_verify($password, $user['passw']);
  }

  function insertUser($username, $password, $email) {
    $date = date('Y-m-d');
    $db = Database::getInstance()->db();
      
      $stmt = $db->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
    $stmt->execute(array($username, $email));
      
      if($stmt->fetch())
        return false;
      
   $options = ['cost' => 12];
    $stmt = $db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $options), null,$email,null,null,$date));
      
      return true;
  }


function editProfileInfo($username,$password,$profileimg,$email,$description,$dateofbirth, $newpassword){

    if(checkPassword($username,$password)){
        
    if($newpassword != ''){
        $db = Database::getInstance()->db();
         $password = $newpassword;
        $statement = $db->prepare('UPDATE users SET passw=?, profileimg= ?, email= ?, description= ?, dateofbirth=? WHERE username = ?');

$options = ['cost' => 12];
$statement->execute(array(password_hash($password, PASSWORD_DEFAULT, $options),$profileimg,$email,$description,$dateofbirth,$username));
       
    }
        
        else{
           $db = Database::getInstance()->db(); 
    $statement = $db->prepare('UPDATE users SET profileimg= ?, email= ?, description= ?, dateofbirth=? WHERE username = ?');
$statement->execute(array($profileimg,$email,$description,$dateofbirth,$username));
        
        }


 
        
         return true;
    }
    return false;
}


?>