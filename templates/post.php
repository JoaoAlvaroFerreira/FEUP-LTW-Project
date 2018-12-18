<?php
  

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";

function draw_post($id){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE postID = ?');
    $stmt->execute(array($id));
    $result = $stmt->fetch();
    
    $votes = getVotesPost($id);
?>
<section id="post_page">
<div id = "full_post">

<?php
    if($result['type'] == "text"){ ?>
    <div class="post_banner">
      <div class="votes">
        <input type="button" value="Upvote">
        <input type="button" value="Downvote">
      </div>
        <span class="post_id"><?=$id?></span>
        <div class = "post_title">
          <?php echo $result['title']; ?>
        </div>
      </div>
      <span id="votes"><?php echo $votes?> Vote(s)</span>
       <div class = "post_content">       
         <?php echo $result['content']; ?>
      </div>
     
<?php
    }
    
  else if($result['type'] == "img"){ ?>
    <div class="post_banner">
      <div class="votes">
      <input type="button" value="Upvote">
      <input type="button" value="Downvote">
    </div> 
    <span class="post_id"><?=$id?></span>
            <div class="post_title">
              <?php echo $result['title']; ?>
            </div>
          </div>
          <span id="votes"><?php echo $votes?> Vote(s)</span>
          <div class = "post_image">
            <img src="<?php echo $result['content'] ?>"> 
          </div>
<?php 
  }
        
  else if($result['type'] == "link"){?>
  <div class="post_banner">
      <div class="votes">
      <input type="button" value="Upvote">
      <input type="button" value="Downvote">
    </div>
    <span class="post_id"><?=$id?></span>
    <div class="post_title">
        <a href="<?php echo $result['content'];?>"> 
        <?php echo $result['title'] ?></a>
    </div>
  </div>
  <span id="votes"><?php echo $votes?> Vote(s)</span>
     
<?php
    }
    
  else if($result['type'] == "video"){?>
   <div class="post_banner">
      <div class="votes">
      <input type="button" value="Upvote">
      <input type="button" value="Downvote">
    </div>
    <span class="post_id"><?=$id?></span>
      <div class = "post_title">
        <?php echo $result['title']; ?>
      </div>
    </div>
    <span id="votes"> <?php echo $votes?> Vote(s)</span>
    <div id="post_video">
<?php //não tocar nisto, é para ler videos de youtube
    $url = $result['content'];
    parse_str( parse_url( $url, PHP_URL_QUERY ), $array_of_vars);
    $str = $array_of_vars['v'];
    draw_video($str);

  }
?>
    </div>
        
<div id="post_footnote">
  Posted by <a href = "../pages/viewProfile.php?username=<?php echo $result['username'];?>">
  <?php 
      $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($result['username']));
    $user = $stmt->fetch();
    
    echo $result['username'];?></a> <?php   
      if($user['profileimg']!= ''){ ?> 
       <img src="<?php echo $user['profileimg']; ?>" width=50 height = 50>  
  <?php
} ?>
    
    
    on <?php echo $result['dateWritten'];
    
    
    
    
  if(isset($_SESSION['username'])) {
    if($result['username'] == $_SESSION['username']){ ?>
        <button onclick="document.getElementById('deletePost').style.display='block'">Delete Post</button>
    <?php
    } }
    ?>
    
       
    
        <div id = "deletePost" class = "container">
   <center><h2>Are you sure? You won't be able to get your post back.</h2>
       
       <form class="editform" method="post" action="../actions/act_delete_post.php">
        <input type="hidden" name="post_id" value=<?php echo $result['postID'];?> >
        <input type="submit" value="Yes"/>
       </form> </center>
        </div>
    
    
  <div id="comment_number"><?php echo getCommentsPost($result['postID']);?> comments</div>
</div>

</div>

  <?php if(isset($_SESSION['username']))
    post_reply_box($id);

}

function getUserPoints($username){
     $db = Database::getInstance()->db();
      
    $stmt = $db->prepare('SELECT * FROM posts WHERE username = ?');
    $stmt->execute(array($username));
    $stories = $stmt->fetchAll();
    $stmt = $db->prepare('SELECT * FROM comments WHERE username = ?');
    $stmt->execute(array($username));
    $comments = $stmt->fetchAll();
    $points = 0;
    
    foreach($stories as $row){
        $points = $points + getVotesPost($row['postID']);
    }
    
     foreach($comments as $row){
        $points = $points + getVotesComment($row['commentID']);
    }
    
    return $points;
    
    
}

function getCommentCountUser($username){
     $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE username = ?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
   
    return count($result);
}

function getPostCountUser($username){
     $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE username = ?');
    $stmt->execute(array($username));
    $result = $stmt->fetchAll();
   
    return count($result);
}

function getVotesPost($id){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM postvotes WHERE postID = ?');
    $stmt->execute(array($id));
    $result = $stmt->fetchAll();
    $votes = 0;
    
    foreach ($result as $row) {
   
    if($row['positive'] == 1)
        $votes = $votes+1;
    else $votes = $votes - 1;
    }
    
    return $votes;
}

function getCommentsPost($id){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE postID = ?');
    $stmt->execute(array($id));
    $result = $stmt->fetchAll();
   
    return count($result);
}



function draw_comments($postID, $fatherID, $level){
 
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE postID = ? AND fatherID = ?');
    $stmt->execute(array($postID,$fatherID));
    $result = $stmt->fetchAll();
    
     if(empty($result))
        return;
     
    
    else{
        
    foreach($result as $row){
        ?> <div id = 'comment'> 
      <?php
      for($count = 0; $count < $level; $count++){ ?>
                +
        <?php        }     ?>
    
    <div id="comment_votes">
    <input type="button" value="Upvote">
    <input type="button" value="Downvote">
    </div>
    <span class="commentid"><?=$row['commentID']?></span>
      
<?php
        $votes = getVotesComment($row['commentID']); 
        ?>
        <span id="votesCom"><?php echo $votes?></span>
        <span class="separator"> | </span>
       <?php echo $row['content'];?>
        
      
      <div id = 'commentfootnote'>Written by <?php echo $row['username']?> on <?php echo $row['dateWritten']?> </div>

<?php
        
         if(isset($_SESSION['username']))
        comment_reply_box($postID, $row['commentID']);
        
        
        $level = $level+1;
        draw_comments($postID, $row['commentID'],$level);
        $level = $level-1;
        
        if(isset($_SESSION['username'])) {
    if($row['username'] == $_SESSION['username']){ ?>
        <button onclick="document.getElementById('deleteComment').style.display='block'">Delete Comment</button>
    <?php
    } }
    ?>
    
       
    
        <div id = "deleteComment" class = "container">
   <center><h2>Are you sure? You won't be able to get your comment back.</h2>
       
       <form class="deleteform" method="post" action="../actions/act_delete_comment.php">
        <input type="hidden" name="post_id" value="<?php echo $row['commentID'];?>" >
        <input type="submit" value="Yes"/>
       </form> </center>
        </div>
       
</div> <?php
        
        
        }
        
    }
}


function getVotesComment($idcomment){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM commentvotes WHERE commentID = ?');
    $stmt->execute(array($idcomment));
    $result = $stmt->fetchAll();
    $votes = 0;
    
   
    foreach ($result as $row) {
   
    if($row['positive'] == 1)
        $votes = $votes+1;
    else $votes = $votes - 1;
    }
    
    return $votes;
    
}

//Isto é a API do YouTube
function draw_video($video){?> 

  <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>

    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '360',
          width: '640',
          videoId: '<?php echo $video; ?>',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 30000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
<?php }

//ids iguais up ahead part 2

 function post_reply_box($postID) { 
?>

  <form method="post" action="../actions/act_comment.php" id = "post_reply">
    <input type="hidden" name="postID" value="<?php echo $postID?>">
    
    <input type="text" name="content" placeholder="Write your reply here...">
      <div>
    <input type="submit" value="Reply" id="postreply">
    <input type="reset" value="Reset">    
      </div>
  </form>

<?php } 

//ids iguais up ahead

 function comment_reply_box($postID, $fatherID) { 
?>
   

  <form method="post" action="../actions/act_comment.php"  class="comment_reply">
    <input type="hidden" name="postID" value="<?php echo $postID?>">
    <input type="hidden" name="fatherID" value="<?php echo $fatherID?>">
  <!--<textarea name="content" placeholder="Write your comment here" form="commentreply" rows="3" cols="40"></textarea>-->
    <input type="text" name="content" placeholder="Write here">
    <div>
    <input type="submit" value="Reply" id="commentreply">
    <input type="reset">
      </div>
  </form>

<?php }  ?>
</section> 