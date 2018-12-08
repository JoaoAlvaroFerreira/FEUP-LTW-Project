<?php

include_once "../database/init.php";

function signUp($username, $password, $date){
    
     $db = Database::instance()->db();
    
    $toDatabase = $db->prepare('INSERT INTO Users (username,passw,dataRegistered) VALUES (?,?,?)');
    
    $toDatabase->execute([$username, $password, $date]);
    
}


function signIn($username, $password){
    
     
     $db = Database::instance()->db();
    
    $statement = $db->prepare('SELECT username,passw FROM Users WHERE username = ? ');
    $statement->execute([$username]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $hashed_password = $result['password'];
    if($password == $hashed_password){
        $_SESSION['login-user']=$username;
        unset($_SESSION["ERROR"]);
        header("location:../pages/index.php");
        exit();
    }
    else {
        $_SESSION["ERROR"] = "Incorrect Password or Username, try again!";
        header("Location:".$_SERVER['HTTP_REFERER']."");
        exit();
    }
}


?>