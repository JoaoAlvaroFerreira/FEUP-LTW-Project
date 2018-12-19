<?php
/**
 * handles the response to the script of the comment's votes
 */
    include_once('../database/session.php');
    include_once('../database/init.php');
    header('Content-Type: application/json');
    // Verify if user is logged in
    if (!isset($_SESSION['username'])){
        die(json_encode('not_logged_in'));
    }
    $username = $_SESSION['username'];
    $com_id = $_POST['com_id'];
    $positive = $_POST['positive'];
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM commentvotes WHERE username = ? AND commentID = ?');
    $stmt->execute(array($username,$com_id));
    $vote = $stmt->fetch();
    //checks if the user hasn't already a vote on certain comment
    if($vote==FALSE){
        //inserts a new vote to that comment
        $stmt = $db->prepare('INSERT INTO commentvotes VALUES(?, ?, ?)');
        $stmt->execute(array($com_id,$username,$positive));
        die(json_encode('new_vote'));
    }
    //the user has already a vote and now checks if has the same value
    if($vote['positive']==$positive){
        //deletes from database the vote from that user in that comment
        $stmt = $db->prepare('DELETE FROM commentvotes WHERE username = ? AND commentID = ?');
        $stmt->execute(array($username,$com_id));
        die(json_encode('take_out'));
    }
    //the user has already a vote and now checks if has a different value
    //updates the value of the vote from that user in that comment
    $stmt = $db->prepare('UPDATE commentvotes SET positive = ? WHERE username = ? AND commentID = ?');
    $stmt->execute(array($positive,$username,$com_id));
    echo json_encode('dif_vote');
?>