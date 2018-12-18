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

    <div id="profileInfo"> 
        <?php if($result['profileimg'] != ''){ ?>
        <div> <img src="<?php echo $result['profileimg']; ?>" width=100 height = 100></div>  
        <?php   } ?>
        
        <div id="user_name">User: <?php echo $result['username']; ?></div>
        
        <div id="date_register">Registed since: <?php echo $result['dataRegistered']; ?></div>
  
        <div id="email">E-Mail: <?php echo $result['email']; ?></div>
        
        <?php if($result['dateofbirth']!= ''){ ?>
        <div id="date_birth">Data of Birth: <?php echo $result['dateofbirth']; ?></div>  <?php }
            
        if($result['description']!= ''){ ?>
        <div id="user_description">Description: <?php echo $result['description']; ?></div>  <?php } ?> 
    </div>
        
   
<?php     
    
     if(isset($_SESSION['username'])) {
    if($username == $_SESSION['username']){ ?>
        <button onclick="document.getElementById('editprofile')" id="edit_button">Edit Profile</button>
<?php } } ?>   

    <center id="editprofile" class="container">
        <form class="editform" method="post" action="../actions/act_edit_profile.php">
            <input type="password" name="password" placeholder="password (verification)" required>
            <input type="password" name ="newpassword" placeholder= "new password (only write here if you intend on changing your password)">
            <input type="text" name="email" placeholder="email" value="<?php echo $result['email']; ?>"required>
            <input type="text" name="profileimg" placeholder="profile image (URL)" value="<?php echo $result['profileimg']; ?>">
            <input type="text" name="description" placeholder="description" value="<?php echo $result['description']; ?>">
         
            <p></p>Date of Birth: <input type="date" name="dateofbirth" placeholder="date of birth" value="<?php echo $result['dateofbirth']; ?>">      
            <div>
                <input type="submit" value="Register">
            </div>
       </form> 
    </center> 
            
<script>

var container = document.getElementById('editprofile');

window.onclick = function(event) {
    if (event.target == container) {
        container.style.display = "none";
    }
}

</script>

<?php 

}


function draw_user_posts($username){
    
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE username=?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
    
    if(empty($result)){
?>
        <h3>This user hasn't made any posts</h3>
<?php
    }
    else{ 
?>
    <div id = "userposts"> 
    <h3>Posts made by this user:</h3>
<?php
    foreach ($result as $row){ 
    $votes = getVotesPost($row['postID']);
?>
    <div id = "userpostlist">
    <a href = "../pages/viewPost.php?id=<?php echo $row['postID'];?>"><?php echo $votes;?> | <?php echo $row['title'];?> on <?php echo $row['dateWritten'];?></a>
    
        
        </div> </div> <?php
        }
    }    
}

function draw_user_comments($username){
    
    
 
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE username=?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
    
    if(empty($result)){
        ?><h4>This user hasn't made any comments</h4><?php
    }else{ ?>
    
    <div id = "usercomments"> <h4>Comments made by this user:</h4>
    <?php
    foreach ($result as $row){ 
        $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE postID=?');
    $stmt->execute(array($row['postID']));
    $post = $stmt->fetch();
        
    $votes = getVotesComment($row['commentID']);
        ?>
    <div id = "usercommentlist">
        <?php echo $votes;?> | <?php echo $row['content'];?> on 
        <a href = "../pages/viewPost.php?id=<?php echo $post['postID'];?>"><?php echo $post['title'];?></a> at <?php echo $row['dateWritten'];?>
    
        
        </div> </div> <?php
        }
    }    
}

?>
