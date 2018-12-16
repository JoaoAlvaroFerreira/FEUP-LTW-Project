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

    <div id = "postlist">
    <button type="button">Upvote</button>
    <button type="button">Downvote</button>
    <a href = "../pages/viewPost.php?id=<?php echo $row['postID']?>"><?php echo $votes?> | <?php echo $row['title']?></a>
    <a href = "../pages/viewProfile.php?username=<?php echo $row['username']?>"> by <?php echo $row['username'];?></a>
   <br>
        
</div>

<?php
        
        
   
    }
    
}
?>
