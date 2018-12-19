<?php

function getUserPoints($username){
     $db = Database::getInstance()->db();
      
    $stmt = $db->prepare('SELECT * FROM posts WHERE username = ?');
    $stmt->execute(array($username));
    $stories = $stmt->fetchAll();
    $stmt = $db->prepare('SELECT * FROM comments WHERE username = ?');
    $stmt->execute(array($username));
    $comments = $stmt->fetchAll();
    $points = 0;
    
    foreach($stories as $row){
        $points = $points + getVotesPost($row['postID']);
    }
    
     foreach($comments as $row){
        $points = $points + getVotesComment($row['commentID']);
    }
    
    return $points;
    
    
}

function getCommentCountUser($username){
     $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE username = ?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
   
    return count($result);
}

function getPostCountUser($username){
     $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE username = ?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
   
    return count($result);
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

function getCommentsPost($id){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE postID = ?');
    $stmt->execute(array($id));
    $result = $stmt->fetchAll();
   
    return count($result);
}

function getVotesComment($idcomment){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM commentvotes WHERE commentID = ?');
    $stmt->execute(array($idcomment));
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