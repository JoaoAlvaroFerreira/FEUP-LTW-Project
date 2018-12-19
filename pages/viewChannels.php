<?php
include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";
include_once "../database/session.php";





draw_header();
draw_channels();
draw_floating_menu();
draw_footer();



function draw_channels(){ 
    

    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts group by channel');
    
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    
    foreach ($result as $row) {

   ?>

    <div id="postlist">
        <div id="post_info">
            
            <a href = "../pages/channel.php?id=<?php echo $row['channel'] ?>"><?php echo $row['channel'] ?></a>
            
            <br>
        </div>
    </div>

<?php     
   
    }
    
}
?>