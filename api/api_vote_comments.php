<?php
    include_once('../database/session.php');
    include_once('../database/init.php');
    header('Content-Type: application/json');
    // Verify if user is logged in
    if (!isset($_SESSION['username'])){
        die(json_encode('not_logged_in'));
    }
    $username = $_SESSION['username'];
    $comm_id = $_POST['comm_id'];
    $positive = $_POST['positive'];
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM commentvotes WHERE username = ? AND commentID = ?');
    $stmt->execute(array($username,$comm_id));
    $vote = $stmt->fetch();
    if($vote==FALSE){
        $stmt = $db->prepare('INSERT INTO commentvotes VALUES(?, ?, ?)');
        $stmt->execute(array($comm_id,$username,$positive));
        die(json_encode('new_vote'));
    }
        
    if($vote['positive']==$positive){
        $stmt = $db->prepare('DELETE FROM commentvotes WHERE username = ? AND commentID = ?');
        $stmt->execute(array($username,$comm_id));
        die(json_encode('take_out'));
    }
    $stmt = $db->prepare('UPDATE commentvotes SET positive = ? WHERE username = ? AND commentID = ?');
    $stmt->execute(array($positive,$username,$comm_id));
    echo json_encode('dif_vote');
?>