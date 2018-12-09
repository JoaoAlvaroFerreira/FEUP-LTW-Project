<?php

 include_once('session.php');

class User {
   var $username;
   var $totalvotes = 0;
   var $posts = array();
   var $comments = array();
 

   function __construct($username)
   {
       
       $this->username = $title;

   }

   function upvote()
   {
       $totalvotes = $votes+1;
   }

   function downvote()
   {
       $totalvotes = $votes-1;
   }
    
   function addComment($comment){
       array_push($comments, $comment);
   }
    
  function addPost($post){
    array_push($posts, $post);
  }
    
    

} 


?>