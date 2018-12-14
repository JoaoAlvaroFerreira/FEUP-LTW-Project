<?php
  

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";

function draw_user_info($username){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $result = $stmt->fetch();
    
    echo "<p>User: ".$result['username']."</p>";
    if(empty($result['dataRegistered']))
        echo "This user chose to not disclose his date of registration.";
    else
        echo "<p>Registed since: ".$result['dataRegistered']."</p>";   
 
    
}

function draw_user_posts($username){
    
    
    
 
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE username=?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
    
    if(empty($result))
        echo "<h3>This user hasn't made any posts</h3>";
    else{
    echo "<h3>Posts made by this user:</h3>";
    foreach ($result as $row) {
    $votes = getVotesPost($row['postID']);
    echo '<a href = "../pages/viewPost.php?id='.$row['postID'].'">'. $votes. " | " .$row['title'] . '</a>';
    echo "<br>";
}
    }
    


    
}


?>