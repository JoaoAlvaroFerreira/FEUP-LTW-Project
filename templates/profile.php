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
        
        
        
          <?php if($result['profileimg'] != ''){ ?>
       <p> <img src="<?php echo $result['profileimg']; ?>" width=100 height = 100></p>  <?php   } ?>
        
        <p>User: <?php echo $result['username']; ?></p>
        
        <p>Registed since: <?php echo $result['dataRegistered']; ?></p>
  
        <p>E-Mail: <?php echo $result['email']; ?></p>
        
        <?php if($result['dateofbirth']!= ''){ ?>
       <p>Data of Birth: <?php echo $result['dateofbirth']; ?></p>  <?php }
            
        if($result['description']!= ''){ ?>
        <p>Description: <?php echo $result['description']; ?></p>  <?php } ?> </div>
        
   
        <?php 
    
    
     if(isset($_SESSION['username'])) {
    if($username == $_SESSION['username']){ ?>
        <button onclick="document.getElementById('editprofile').style.display='block'">Edit Profile</button>
    <?php
    } }
    ?>
    
       
    
        <div id = "editprofile" class = "container">
    
 
   <center><form class="editform" method="post" action="../actions/act_edit_profile.php">
        <input type="password" name="password" placeholder="password (verification)" required>
         <input type="password" name ="newpassword" placeholder= "new password (only write here if you intend on changing your password)">
        <input type="text" name="email" placeholder="email" value="<?php echo $result['email']; ?>"required>
        <input type="text" name="profileimg" placeholder="profile image (URL)" value="<?php echo $result['profileimg']; ?>">
        <input type="text" name="description" placeholder="description" value="<?php echo $result['description']; ?>">
        <br>
        Date of Birth: <input type="date" name="dateofbirth" placeholder="date of birth" value="<?php echo $result['dateofbirth']; ?>">
        
        <center><input type="submit" value="Register"></center>
       </form> </center>
        </div>
        
            
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
   <br>
        
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
   <br>
        
        </div> </div> <?php
        }
    }    
}

?>
