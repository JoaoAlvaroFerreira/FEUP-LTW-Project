<?php
  include_once('../database/db_user.php');
  include_once ('../database/session.php');
  


$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
 
  if (checkPassword($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['message'] = 'Logged in!';
  } else {
      
    $_SESSION['message'] = 'That password and/or username are incorrect! Please try again or register if you haven\'t';
  }

header('Location: ../pages/frontpage.php');
?>