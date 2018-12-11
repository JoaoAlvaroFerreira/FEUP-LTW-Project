<?php

 include_once('session.php');

class Post {
   var $postId;
   var $title;
   var $user;
   var $type;
   var $content; //can be text, image or link (this would be processed in text form regardless)
   var $comments = array();
   var $votes = 0;
   var $postdate;

   function __construct($title, $type, $content, $user)
   {
       $this->postId = $_SESSION['token'] + $user + 'post' + md5(uniqid(rand(), true));
       $this->title = $title;
       $this->content = $content;
       $this->type = $type;
       $this->user = $user;
       $this->postdate = date('Y-m-d H:i:s');
       
       

   }

   function upvote()
   {
       $votes = $votes+1;
   }

   function downvote()
   {
       $votes = $votes-1;
   }
    
   function addComment($comment){
       array_push($comments, $comment);
   }
    
    

} 
/*class Comment extends Post {

   $commentId;
   $commentDate;
    
   function __construct()
   {
       parent::__construct(null, 'text', $content);
       $this->commentId = $_SESSION['token'] + $user + 'post' + md5(uniqid(rand(), true));
       $this->commentDate = date('Y-m-d H:i:s');
   }

}*/

?>