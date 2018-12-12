<?php

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";


draw_header();
draw_content();
draw_posts();

function draw_posts(){
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts');
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
    echo '<a href = "../pages/viewPost.php?id='.$row['postID'].'">'. $row['title'] . '</a>';
    echo "<br>";
}
    
}


?>