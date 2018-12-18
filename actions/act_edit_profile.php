<?php
  include_once('../database/db_user.php');
  include_once ('../database/session.php');
  

$password = htmlspecialchars($_POST['password']);
$newpassword = htmlspecialchars($_POST['newpassword']);
$profileimg = htmlspecialchars($_POST['profileimg']);
$email = htmlspecialchars($_POST['email']);
$description = htmlspecialchars($_POST['description']);
$dateofbirth = htmlspecialchars($_POST['dateofbirth']);
$username = $_SESSION['username'];



if(strlen($password) > 6){
  try{
      if(editProfileInfo($username,$password, $profileimg, $email,$description,$dateofbirth,$newpassword)){
    $_SESSION['message'] = 'Edited profile succesfully!';
      }
      else $_SESSION['message'] = 'Editing failed';
  }catch (PDOException $e) {
   $_SESSION['message'] = 'Issues with database';

  }
}
else{
    $_SESSION['message'] = 'That password is too short, try one with more than 6 characters!';
}

header('Location: ../pages/viewProfile.php?username='.$username);
?>