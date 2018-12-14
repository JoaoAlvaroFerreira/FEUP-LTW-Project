<?php
  

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";

function draw_post($id){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE postID = ?');
    $stmt->execute(array($id));
    $result = $stmt->fetch();
    
    $votes = getVotesPost($id);
    
        
    if($result['type'] == "text"){
    echo "<h2>".$votes." | ".$result['title']."</h2>";
    echo $result['content'].'<br>';
    }
    
    else if($result['type'] == "img"){
    echo "<h2>".$votes." | ".$result['title']."</h2>";
    echo '<img src='.$result['content'].' alt="'.$result['title'].'"> <br>';
    }
        
    else if($result['type'] == "link")
    echo "<h2>".$votes." | <a href=".$result['content'].">".$result['title']."</a></h2>";
        
    echo 'Post by <a href = "../pages/viewProfile.php?username='.$result['username'].'">'. $result['username'] .'</a> on '.$result['dateWritten'];
    
    post_reply_box($id);

}

function getVotesPost($id){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM postvotes WHERE postID = ?');
    $stmt->execute(array($id));
    $result = $stmt->fetchAll();
    $votes = 0;
    
    foreach ($result as $row) {
   
    if($row['positive'] == 1)
        $votes = $votes+1;
    else $votes = $votes - 1;
    }
    
    return $votes;
}

function draw_comments($postID, $fatherID, $level){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE postID = ? AND fatherID = ?');
    $stmt->execute(array($postID,$fatherID));
    $result = $stmt->fetchAll();
    
     if(empty($result))
        return;
    
    else{
        
    foreach($result as $row){
        
      
         for ($counter = 0; $counter<$level; $counter++) {
    echo "_";
      }
        $votes = getVotesComment($row['postID'],$row['commentID']);
        echo $votes. " | ";
        echo $row['content']."<br>";
        echo $fatherID;
        
      
        echo "Written by ".$row['username']." on " .$row['dateWritten'].".";
        
        comment_reply_box($postID, $fatherID);
        $level = $level+1;
        draw_comments($postID, $row['commentID'],$level);
        }
        
    }
}

function getVotesComment($idpost, $idcomment){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM commentvotes WHERE postID = ? AND commentId = ?');
    $stmt->execute(array($idpost, $idcomment));
    $result = $stmt->fetchAll();
    $votes = 0;
    
   
    foreach ($result as $row) {
   
    if($row['positive'] == 1)
        $votes = $votes+1;
    else $votes = $votes - 1;
    }
    
    return $votes;
    
}

 function post_reply_box($postID) { 
?>
<!DOCTYPE HTML>
<html>
  <section id="postreply">
    

    <form method="post" action="../actions/act_comment.php" id = "postreply">
        <input type="hidden" name="postID" value="<?php echo $postID?>">
        <br>
  <!--   <textarea name="content" placeholder="Write your comment here" form="postreply" rows="3" cols="40"></textarea>-->
       <input type="text" name="content" placeholder="Write here">
        <br>
      <input type="submit" value="Reply" id="postreply">
      <input type="reset" id="postreply">
         
    </form>


  </section>
</html>

<?php } 

 function comment_reply_box($postID, $fatherID) { 
?>
<html>
  <section id="commentreply">
    

   
    <form method="post" action="../actions/act_comment.php" id="commentreply">
        <input type="hidden" name="postID" value="<?php echo $postID?>">
        <input type="hidden" name="fatherID" value="<?php echo $fatherID?>">
  <!--<textarea name="content" placeholder="Write your comment here" form="commentreply" rows="3" cols="40"></textarea>-->
        <input type="text" name="content" placeholder="Write here">
        <br>
      <input type="submit" value="Reply" id="commentreply">
      <input type="reset">
         
        
    </form>


  </section>
</html>
<?php }  

?>