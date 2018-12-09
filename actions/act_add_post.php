<?php
  include_once('../database/db_user.php');
  include_once ('../database/session.php');
  include_once('../database/post.php');

  $title = $_POST['title'];
  $type = $_POST['type'];
  $content = $_POST['content'];
  $user = $_SESSION['username'];
 
  if (checkPassword($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['message'] = 'Logged in!';
  } else {
      
    $_SESSION['message'] = 'That password and/or username are incorrect! Please try again or register if you haven\'t';
  }

header('Location: ../pages/frontpage.php');
?>