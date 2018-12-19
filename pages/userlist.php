<?php
include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";
include_once "../database/session.php";





draw_header();
draw_users();
draw_floating_menu();
draw_footer();


   
function cmpPoints($a, $b)
{
    if (getUserPoints($a['username']) == getUserPoints($b['username'])) {
        return 0;
    }
    return (getUserPoints($a['username']) > getUserPoints($b['username'])) ? -1 : 1;
}

function cmpComments($a, $b)
{
    if (getCommentCountUser($a['username']) == getCommentCountUser($b['username'])) {
        return 0;
    }
    return (getCommentCountUser($a['username']) > getCommentCountUser($b['username'])) ? -1 : 1;
}

function cmpPosts($a, $b)
{
    if (getPostCountUser($a['username']) == getPostCountUser($b['username'])) {
        return 0;
    }
    return (getPostCountUser($a['username']) > getPostCountUser($b['username'])) ? -1 : 1;
}


function cmpDate($a, $b)
{
   
    
    return strcmp($a['dataRegistered'],$b['dataRegistered']);
}

function cmpName($a, $b)
{
   
    
    return strcmp(strtolower($a['username']),strtolower($b['username']));
}


function draw_users(){
   
    
    $sortType = "points";
if(isset($_GET['sort']))
    $sortType = htmlspecialchars($_GET['sort']);

    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM users');
    
    $stmt->execute();
    $result = $stmt->fetchAll();
   
    
     if($sortType == "points")
    usort($result, "cmpPoints");
    
    else if($sortType == "date")
    usort($result, "cmpDate");
    
    else if($sortType == "posts")
    usort($result, "cmpPosts");
    
    else if($sortType == "name")
    usort($result, "cmpName");
    
    else if($sortType == "comments")
    usort($result, "cmpComments");
    
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
?>