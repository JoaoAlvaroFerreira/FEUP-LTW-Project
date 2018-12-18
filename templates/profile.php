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
    
    ?>
    <div id = "profileInfo">
        <p>User: <?php echo $result['username']; ?></p> <?php
    if(empty($result['dataRegistered'])){
        ?>
        This user chose to not disclose his date of registration.
        <?php
    }else {
        ?>
        <p>Registed since: <?php echo $result['dataRegistered']; ?></p>
    <?php
if(!empty($result['email'])) ?>
        <p>E-Mail: <?php echo $result['email']; ?></p>
        
        

</div>
<?php }
}

function draw_user_posts($username){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE username=?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
    
    if(empty($result)){?>
    <div class="little_title">
        <h3>This user hasn't made any posts</h3>
    </div>
<?php
    }
    
    else{ ?> 
        <div id = "userposts">
            <div class="little_title">
                <h3>Posts made by this user:</h3>
            </div>
<?php
        foreach ($result as $row){ 
            $votes = getVotesPost($row['postID']);
?>
            <div id = "user_postlist">
                <?php echo $votes?>
                <span class="separator"> | </span>
                <a href = "../pages/viewPost.php?id=<?php echo $row['postID'];?>"><?php echo $row['title'];?></a>
            </div>
        </div> 
<?php
        }
    }    
}

?>
