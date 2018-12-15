<?php
  include_once('../database/db_user.php');
  include_once ('../database/session.php');
  

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);


    
    

$email = htmlspecialchars($_POST['email']);

if(strlen($password) > 6){
  try{
      if(insertUser($username,$password, $email)){
    $_SESSION['username'] = $username;
    $_SESSION['message'] = 'Signed up and logged in!';
      }
      else $_SESSION['message'] = 'That e-mail and/or username are already taken!';
  }catch (PDOException $e) {
   $_SESSION['message'] = 'Issues with database';

  }
}
else{
    $_SESSION['message'] = 'That password is too short, try one with more than 6 characters!';
}

header('Location: ../pages/frontpage.php');
?>