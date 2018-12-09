
<?php

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";

draw_header();


?>

<!DOCTYPE HTML>

<html>
    
    <form action="../actions/add_post.php" method="post" name = "post">
  Title: <input type="text" name="title"><br>   
  <input type="radio" name="type" value="Link"> Link
  <input type="radio" name="type" value="Image"> Image
  <input type="radio" name="type" value="Text"> Text
  
        

</form>
    
    <textarea name="comment" placeholder="Write your post or paste your url here" form="post" rows="20" cols="100"></textarea> <br>
      <input type="submit" value="Submit" form="post">
      <input type="reset" form="post">
    
<?php
    
    

    ?>
    