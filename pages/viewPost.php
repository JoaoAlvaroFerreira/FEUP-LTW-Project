<?php

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";

draw_header();

draw_posts();

function draw_posts(){
   
  $id = $_GET['id'];


  echo "<p>" . $id . "</p>";


}

?>