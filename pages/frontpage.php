<?php

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";


draw_header();
draw_content();
draw_posts();


function draw_posts(){
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts');
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
    $votes = getVotesPost($row['postID']);
    echo '<a href = "../pages/viewPost.php?id='.$row['postID'].'">'. $votes. " | " .$row['title'] . '</a>';
    echo '<a href = "../pages/viewProfile.php?username='.$row['username'].'">'. " by " .$row['username'] . '</a>';
    echo "<br>";
}
    
}




?>