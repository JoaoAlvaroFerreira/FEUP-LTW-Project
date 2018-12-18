<?php
include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";



$search = htmlspecialchars($_GET['search']);
$type = htmlspecialchars($_GET['Type']);
$sort = htmlspecialchars($_GET['Sort']);

draw_header();
if($type == "Users")
draw_users_search($search, $sort);

else if($type == "Comments")
draw_comments_search($search, $sort);
else if ($type == "Posts")
draw_posts_search($search, $sort);

draw_floating_menu();
draw_footer();


   
function cmpPointsUsers($a, $b)
{
    if (getUserPoints($a['username']) == getUserPoints($b['username'])) {
        return 0;
    }
    return (getUserPoints($a['username']) > getUserPoints($b['username'])) ? -1 : 1;
}



function cmpPointsPost($a, $b)
{
    if (getVotesPost($a['postID']) == getVotesPost($b['postID'])) {
        return 0;
    }
    return (getVotesPost($a['postID']) > getVotesPost($b['postID'])) ? -1 : 1;
}

function cmpPointsComment($a, $b)
{
    if (getVotesComment($a['commentID']) == getVotesComment($b['commentID'])) {
        return 0;
    }
    return (getVotesComment($a['commentID']) > getVotesComment($b['postID'])) ? -1 : 1;
}


function cmpDateUsers($a, $b)
{  
    return -strcmp($a['dataRegistered'],$b['dataRegistered']);
}

function cmpDate($a, $b)
{
    return -strcmp($a['dateWritten'],$b['dateWritten']);
}


function draw_users_search($search, $sort){
   
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM users WHERE username LIKE ?');
    
    $stmt->execute(array('%'.$search.'%'));
    $result = $stmt->fetchAll();
   
    
     if($sort== "votes")
    usort($result, "cmpPointsUsers");
    
    else if($sort == "new")
    usort($result, "cmpDateUsers");
    
  
    
    foreach ($result as $row) {

    $votes = getUserPoints($row['username']);?>

    <div id="postlist">
        <div id="post_info">
            <?php echo $votes?>
            <span class="separator"> | </span>
            <a href = "../pages/viewProfile.php?username=<?php echo $row['username']?>"><?php echo $row['username']?></a>
            <?php   if($row['profileimg']!= ''){ ?>          
       <img src="<?php echo $row['profileimg']; ?>" width=50 height = 50> <?php } ?>
             
        </div>
    </div>

<?php     
   
    }
    
}


function draw_posts_search($search,$sort){ 
    
   
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE content LIKE ? OR title LIKE ?');
    
    $stmt->execute(array('%'.$search.'%','%'.$search.'%'));
    $result = $stmt->fetchAll();
    
    if($sort == "votes")
    usort($result, "cmpPointsPost");
    
    else if($sort == "new")
    usort($result, "cmpDate");
    
    
    foreach ($result as $row) {

    $votes = getVotesPost($row['postID']);?>

    <div id="postlist">
        <div class="votes_frontpage">
            <input type="button" value="Upvote">
            <input type="button" value="Downvote">
        </div>
        <div id="post_info">
            <?php echo $votes?>
            <span class="separator"> | </span>
            <a href = "../pages/viewPost.php?id=<?php echo $row['postID']?>"><?php echo $row['title']?></a>
            <span class="separator">by</span>
            <a href = "../pages/viewProfile.php?username=<?php echo $row['username']?>"><?php echo $row['username'];?></a>
             
        </div>
    </div>

<?php     
   
    }
    
}
function draw_comments_search($search,$sort){ 
    
   
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE content LIKE ?');
    
    $stmt->execute(array('%'.$search.'%'));
    $result = $stmt->fetchAll();
    
    if($sort == "votes")
    usort($result, "cmpPointsComment");
    
    else if($sort == "new")
    usort($result, "cmpDate");
    
    
    foreach ($result as $row) {
        $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts WHERE postID=?');
    $stmt->execute(array($row['postID']));
    $post = $stmt->fetch();

   $votes = getVotesComment($row['commentID']);
        ?>
    <div id = "usercommentlist">
        <?php echo $votes;?> | <?php echo $row['content'];?> on 
        <a href = "../pages/viewPost.php?id=<?php echo $row['postID'];?>"><?php echo $post['title'];?></a> at <?php echo $row['dateWritten'];?>
        </div> 
    </div> 
<?php
   
    }
    
}
?>