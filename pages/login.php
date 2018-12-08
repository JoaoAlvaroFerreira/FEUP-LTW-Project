<?php

include_once "../database/init.php";


    include_once "../database/database.php";
    include_once "../pages/user.php";

   
        $username = $_POST['username'];
        $password = $_POST['password'];
   
       


if($username && $password){
   try {
    signIn($username, $password);
    $_SESSION['username'] = $username;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
    header('Location: ../pages/index.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
    header('Location: ../pages/signup.php');
  }


    }
    
  header('Location: ../pages/index.php');
        
?>