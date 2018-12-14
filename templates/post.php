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
    
        echo "<h2>".$votes." | ".$result['title']."</h2>";
    if($result['type'] == "text")
    echo $result['content'].'<br>';
    
    if($result['type'] == "img")
    echo '<img src='.$result['content'].' alt="Flowers in Chania"> <br>';
        
    echo 'Post by <a href = "../pages/viewProfile.php?username='.$result['username'].'">'. $result['username'] . '</a>';

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

?>