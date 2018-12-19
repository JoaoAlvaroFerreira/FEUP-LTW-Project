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
       <p> <img src="<?php echo $result['profileimg']; ?>" width=100 height = 100></p>  
       <?php   } ?>
        
        <p>User: <?php echo $result['username']; ?></p>
        
        <p>Registed since: <?php echo $result['dataRegistered']; ?></p>
  
        <p>E-Mail: <?php echo $result['email']; ?></p>
        
        <?php if($result['dateofbirth']!= ''){ ?>
       <p>Data of Birth: <?php echo $result['dateofbirth']; ?></p>  <?php }
            
        if($result['description']!= ''){ ?>
        <p>Description: <?php echo $result['description']; ?></p>  <?php } ?> 
    </div>
        
   
<?php     
    
    if(isset($_SESSION['username'])) {
    if($username == $_SESSION['username']){ ?>
        <button id="edit_button" onclick="document.getElementById('editprofile').style.display='block'">Edit Profile</button>
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
            
 
      

<?php 

}




function draw_user_posts($username){
    
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE username=?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
    
    if(empty($result)){
?>
        <h3  class = "userposts">This user hasn't made any posts</h3>
<?php
    }
    else{ 
?>
    <div> 
    <h3  class = "userposts">Posts made by this user:</h3>
<?php
    foreach ($result as $row){ 
    $votes = getVotesPost($row['postID']);
?>
    <div id = "userpostlist">
        <span id="votes"><?php echo $votes?></span>
        <span class="separator"> | </span>
        <a href = "../pages/viewPost.php?id=<?php echo $row['postID']?>"><?php echo $row['title']?></a>
        <span class="separator">on</span>
        <?php echo $row['dateWritten']?>
    </div> 
    </div> 
<?php
        }
    }    
}

function draw_user_comments($username){
    
    
 
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE username=?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
    
    if(empty($result)){
        ?><h4 class = "usercomments">This user hasn't made any comments</h4><?php
    }else{ ?>
    
    <div> 
        <h4 class = "usercomments">Comments made by this user:</h4>
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

