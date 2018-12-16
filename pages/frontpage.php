<?php
include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";


draw_header();
draw_posts();
draw_floating_menu();
draw_footer();

function draw_posts(){ 

    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts');
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {

    $votes = getVotesPost($row['postID']);?>

    <div id = "postlist">
    <a href = "../pages/viewPost.php?id=<?php echo $row['postID']?>"><?php echo $votes?> | <?php echo $row['title']?></a>
    <a href = "../pages/viewProfile.php?username=<?php echo $row['username']?>"> by <?php echo $row['username'];?></a>
   <br>
        
</div>

<?php
   
    }
    
}
?>
