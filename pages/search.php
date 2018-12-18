<?php
include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";



$search = htmlspecialchars($_POST['search']);
$type = $_POST['Type'];
$sort = $_POST['Sort'];

draw_header();
if($type == "users")
draw_users_search($search, $sort);

else if($type == "comments")
draw_comments_search($search, $sort);
else if ($type == "posts")
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
   
    
    return strcmp($a['dataRegistered'],$b['dataRegistered']);
}

function cmpDate($a, $b)
{
   
    
    return -strcmp($a['dateWritten'],$b['dateWritten']);
}



function draw_users_search($search, $sort){
   
    

    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM users WHERE username LIKE ? OR description LIKE ?');
    
    $stmt->execute(array($search,$search));
    $result = $stmt->fetchAll();
   
    
     if($sortType == "votes")
    usort($result, "cmpPointsUsers");
    
    else if($sortType == "date")
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
            <br>
        </div>
    </div>

<?php     
   
    }
    
}
?>