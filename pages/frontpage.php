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

    
function cmpPoints($a, $b)
{
    if (getVotesPost($a['postID']) == getVotesPost($b['postID'])) {
        return 0;
    }
    return (getVotesPost($a['postID']) > getVotesPost($b['postID'])) ? -1 : 1;
}

function cmpComments($a, $b)
{
    if (getCommentsPost($a['postID']) == getCommentsPost($b['postID'])) {
        return 0;
    }
    return (getCommentsPost($a['postID']) > getCommentsPost($b['postID'])) ? -1 : 1;
}

function cmpDate($a, $b)
{
   
    
    return -strcmp($a['dateWritten'],$b['dateWritten']);
}


function draw_posts(){ 
    
    $sortType = "points";
if(isset($_GET['sort']))
    $sortType = $_GET['sort'];

    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM posts');
    
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    if($sortType == "points")
    usort($result, "cmpPoints");
    
    else if($sortType == "new")
    usort($result, "cmpDate");
    
    else if($sortType == "comments")
    usort($result, "cmpComments");
    
    foreach ($result as $row) {

    $votes = getVotesPost($row['postID']);?>

    <div id="postlist">
        <div class="votes_frontpage">
            <input type="button" value="Upvote">
            <input type="button" value="Downvote">
        </div>
        <div id="post_info">
            <span id="votes"><?php echo $votes?></span>
            <span class="post_id"><?=$row['postID']?></span>
            <span class="separator"> | </span>
            <a href = "../pages/viewPost.php?id=<?php echo $row['postID']?>"><?php echo $row['title']?></a>
            <span class="separator">by</span>
            <a href = "../pages/viewProfile.php?username=<?php echo $row['username']?>"><?php echo $row['username'];?></a>
             
        </div>
    </div>

<?php     
   
    }
    
}
?>
