<?php
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
    if($vote==FALSE){
        $stmt = $db->prepare('INSERT INTO postvotes VALUES(?, ?, ?)');
        $stmt->execute(array($post_id,$username,$positive));
        die(json_encode('new_vote'));
    }
        
    if($vote['positive']==$positive){
        $stmt = $db->prepare('DELETE FROM postvotes WHERE username = ? AND postID = ?');
        $stmt->execute(array($username,$post_id));
        die(json_encode('take_out'));
    }
    $stmt = $db->prepare('UPDATE postvotes SET positive = ? WHERE username = ? AND postID = ?');
    $stmt->execute(array($positive,$username,$post_id));
    echo json_encode('dif_vote');
?>