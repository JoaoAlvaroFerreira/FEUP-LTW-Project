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
    
<div id = "full_post">

<?php
    if($result['type'] == "text"){ ?>
    <div class="post_banner">
      <div class="votes">
        <input type="button" value="Upvote">
        <input type="button" value="Downvote">
      </div>
        <div class = "post_title">
          <?php echo $result['title']; ?>
        </div>
      </div>
      <div class="post_votes">
          <?php echo $votes; ?><span> Vote(s)</span>
        </div>
      <div class = "post_content">       
        <?php echo $result['content']; ?>
      </div>
    <br>
<?php
    }
    
  else if($result['type'] == "img"){ ?>
  <div class="post_banner">
      <div class="votes">
      <input type="button" value="Upvote">
      <input type="button" value="Downvote">
    </div> 
            <div class="post_title">
              <?php echo $result['title']; ?>
            </div>
          </div>
          <div class="post_votes">
            <?php echo $votes; ?>
          </div>
          <div class = "post_content">
            <img src="<?php echo $result['content'] ?>"><br>
          </div>
<?php 
  }
        
  else if($result['type'] == "link"){?>
  <div class="post_banner">
      <div class="votes">
      <input type="button" value="Upvote">
      <input type="button" value="Downvote">
    </div>
    <div class="post_title">
        <?php echo $result['title'] ?></a>
    </div>
  </div>
      <div class="post_votes">
        <?php echo $votes; ?>
      </div>
      <div class = "post_content">
        <a href="<?php echo $result['content'];?>">
      </div>
<?php
    }
    
  else if($result['type'] == "video"){?>
   <div class="post_banner">
      <div class="votes">
      <input type="button" value="Upvote">
      <input type="button" value="Downvote">
    </div>
      <div class = "post_title">
        <?php echo $result['title']; ?>
      </div>
    </div>
    <div class="post_votes">
        <?php echo $votes; ?>
      </div>
        
<?php //não tocar nisto, é para ler videos de youtube
    $url = $result['content'];
    parse_str( parse_url( $url, PHP_URL_QUERY ), $array_of_vars);
    $str = $array_of_vars['v'];
    draw_video($str);

  }
?>
        
<div id="post_footnote">
  Posted by <a href = "../pages/viewProfile.php?username=<?php echo $result['username'];?>">
  <?php echo $result['username'];?></a> on <?php echo $result['dateWritten'];?>
  <div id="comment_number"><?php echo getCommentsPost($result['postID']);?> comments</div>
</div>

</div>

  <?php if(isset($_SESSION['username']))
    post_reply_box($id);

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
    echo "<br>";
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE postID = ? AND fatherID = ?');
    $stmt->execute(array($postID,$fatherID));
    $result = $stmt->fetchAll();
    
     if(empty($result))
        return;
     
    
    else{
        
    foreach($result as $row){
         echo "<div id = 'comment'> ";
         for ($counter = 0; $counter<$level; $counter++) {
    echo "______";
      }
        ?>
    <button type="button">Upvote</button>
    <button type="button">Downvote</button>
<?php
        $votes = getVotesComment($row['postID'],$row['commentID']);
        
        echo $votes. " | ";
        echo $row['content']."</div><br>";
        
      
        echo "Written by ".$row['username']." on " .$row['dateWritten'].".";
        
         if(isset($_SESSION['username']))
        comment_reply_box($postID, $row['commentID']);
        
        $level = $level+1;
        draw_comments($postID, $row['commentID'],$level);
        echo "<br>";
        $level = $level-1;
        }
        
    }
}


function getVotesComment($idpost, $idcomment){
    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM commentvotes WHERE commentId = ?');
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

  <form method="post" action="../actions/act_comment.php" id = "postreply">
    <input type="hidden" name="postID" value="<?php echo $postID?>">
      <br>
  <!--   <textarea name="content" placeholder="Write your comment here" form="postreply" rows="3" cols="40"></textarea>-->
    <input type="text" name="content" placeholder="Write here">
      <br>
    <input type="submit" value="Reply" id="postreply">
    <input type="reset" id="postreply">    
  </form>

<?php } 

//ids iguais up ahead

 function comment_reply_box($postID, $fatherID) { 
?>
   

  <form method="post" action="../actions/act_comment.php"  id="commentreply">
    <input type="hidden" name="postID" value="<?php echo $postID?>">
    <input type="hidden" name="fatherID" value="<?php echo $fatherID?>">
  <!--<textarea name="content" placeholder="Write your comment here" form="commentreply" rows="3" cols="40"></textarea>-->
    <input type="text" name="content" placeholder="Write here">
    <br>
    <input type="submit" value="Reply" id="commentreply">
    <input type="reset">
  </form>

<?php }  ?>