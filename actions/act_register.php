<?php
  include_once('../database/db_user.php');
  include_once ('../database/session.php');
  

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$email = htmlspecialchars($_POST['email']);

  try{
      if(insertUser($username,$password, $email)){
    $_SESSION['username'] = $username;
    $_SESSION['message'] = 'Signed up and logged in!';
      }
      else $_SESSION['message'] = 'That password and/or username are already taken!';
  }catch (PDOException $e) {
   $_SESSION['message'] = 'Issues with database';

  }

header('Location: ../pages/frontpage.php');
?>