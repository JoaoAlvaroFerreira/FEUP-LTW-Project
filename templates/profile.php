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
        if(!is_null($result['email'])){ ?>
        <p>E-Mail: <?php echo $result['email']; ?></p>
        
      <?php}  
        
        if(!is_null($result['dateofbirth'])){?>
       <p>Data of Birth: <?php echo $result['dateofbirth']; ?></p>  <?php}
            
        if(!is_null($result['description'])){?>
       <p>Description: <?php echo $result['description']; ?></p>  <?php}
        
        if(!is_null($result['profileimg'])){?>
       <p>Profile Image: <img src="<?php echo $result['profileimg']; ?>"></p>  <?php}
        
        
           if($username == $_SESSION['username']){ ?>
        <button onclick="document.getElementById('editprofile').style.display='block'">Edit Profile</button>
    
       
    
 
    
        <div id = "editprofile" class = "container">
    
 
    <form class="editform" method="post" action="../actions/act_edit_profile.php">
        <input type="text" name="username" placeholder="username" value="<?php echo $username; ?>"required>
        <input type="password" name="password" placeholder="password" required>
        <input type="text" name="email" placeholder="email" value="<?php echo $result['email']; ?>"required>
        <input type="text" name="profileimg" placeholder="profile image (URL)" value="<?php echo $result['profileimg']; ?>">
        <input type="text" name="description" placeholder="description" value="<?php echo $result['description']; ?>">
        <br>
        <input type="date" name="dateofbirth" placeholder="date of birth" value="<?php echo $result['dateofbirth']; ?>">
        
        <center><input type="submit" value="Register"></center>
    </form>
        </div>
        <?php } ?>
            
            <script>

var container = document.getElementById('editprofile');

window.onclick = function(event) {
    if (event.target == container) {
        container.style.display = "none";
    }
}

</script>

</div>
<?php }
}

function draw_user_posts($username){
    
    
 
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE username=?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
    
    if(empty($result)){
        ?><h3>This user hasn't made any posts</h3><?php
    }else{ ?>
    
    <div id = "userposts"> <h3>Posts made by this user:</h3>
    <?php
    foreach ($result as $row){ 
    $votes = getVotesPost($row['postID']);
        ?>
    <div id = "userpostlist">
    <a href = "../pages/viewPost.php?id=<?php echo $row['postID'];?>"><?php echo $votes;?> | <?php echo $row['title'];?></a>
   <br>
        
        </div> </div> <?php
        }
    }    
}

?>
