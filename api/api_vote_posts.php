<?php
/**
 * handles the response to the script of the post's votes
 */
    include_once('../database/session.php');
    include_once('../database/init.php');
    header('Content-Type: application/json');
    // Verify if user is logged in
    if (!isset($_SESSION['username'])){
        die(json_encode('not_logged_in'));
    }
    $username = $_SESSION['username'];
    $post_id = $_POST['post_id'];
    $positive = $_POST['positive'];
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM postvotes WHERE username = ? AND postID = ?');
    $stmt->execute(array($username,$post_id));
    $vote = $stmt->fetch();
    //checks if the user hasn't already a vote on certain post
    if($vote==FALSE){
        //inserts a new vote to that post
        $stmt = $db->prepare('INSERT INTO postvotes VALUES(?, ?, ?)');
        $stmt->execute(array($post_id,$username,$positive));
        die(json_encode('new_vote'));
    }
    //the user has already a vote and now checks if has the same value    
    if($vote['positive']==$positive){
        //deletes from database the vote from that user in that post
        $stmt = $db->prepare('DELETE FROM postvotes WHERE username = ? AND postID = ?');
        $stmt->execute(array($username,$post_id));
        die(json_encode('take_out'));
    }
    //the user has already a vote and now checks if has a different value
    //updates the value of the vote from that user in that post
    $stmt = $db->prepare('UPDATE postvotes SET positive = ? WHERE username = ? AND postID = ?');
    $stmt->execute(array($positive,$username,$post_id));
    echo json_encode('dif_vote');
?>