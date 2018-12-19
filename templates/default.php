<?php
    include_once "../templates/auth.php";
include_once "../database/session.php";
?>
<?php function draw_header() {
?>
<!DOCTYPE html>

<html lang="en-US">

<head>
    <meta charset="utf-8">
    <title>RocketBoost</title>
    <link href="../css/style.css" rel="stylesheet">
<link rel="icon" href="..//pages/images/fire_icon.png">
<script src="../JS/script.js" defer></script>
<script src="../JS/formLeave.js" defer></script>
<script src="../JS/moveMenu.js" defer></script>
</head>

<body>
    <header id="logo_tabmenu">       
   <div id="logo"><a href="../pages/frontpage.php"><img src="images/logo.png" alt="A rocket, site icon"></a></div>
    <nav class="nav">
    <ul>
        <li>
            <a href="#">Users</a>
        <ul>
                <li><a href="../pages/userlist.php?sort=points">Sort by Points</a></li>
                <li><a href="../pages/userlist.php?sort=name">Sort by Name</a></li>
                <li><a href="../pages/userlist.php?sort=date">Sort by Date of Registry</a></li>
                <li><a href="../pages/userlist.php?sort=posts">Sort by Posts</a></li>
                <li><a href="../pages/userlist.php?sort=comments">Sort by Comments</a></li>
        </ul>
            </li>
        <li>
            <a href="#">Stories</a>
            <ul>
                <li><a href="../pages/frontpage.php?sort=points">Most Voted</a></li>
                <li><a href="../pages/frontpage.php?sort=new">Most Recent</a></li>
                <li><a href="../pages/frontpage.php?sort=comments">Most Comments</a></li>
            </ul>
        </li>
        <li>
            <a href="../pages/viewChannels.php">Channels</a>
        </li>
        <li>
            <a href="#">Settings</a>
            <ul>
               
                <?php if(isset($_SESSION['username'])){ ?>
               <li><a href="../pages/viewProfile.php?username=<?php echo $_SESSION['username']?>">Your Profile</a></li>
               <li> <a href = "../actions/act_log_out.php"> Log Out</a></li>
               <?php }else{ ?>
               <li><a onclick="document.getElementById('register').style.display='block'">Register</a></li>
                <li><a onclick="document.getElementById('login').style.display='block'">Log In</a></li>
                <?php }?>
            </ul>
        </li>
    </ul>
        
    <div class="search-container">
    <form action="../pages/search.php">
        
         <select name="Sort" class="search_options">
            <option value="new">New</option>
            <option value="votes">Votes</option>
        </select>
        <select name="Type" class="search_options">
            <option value="Posts">Stories</option>
            <option value="Comments">Comments</option>
            <option value="Users">Users</option>
            <option value="Channels">Channels</option>
        </select>
     
        <input type="text" placeholder="Search.." name="search">
          <button type="submit">Go!</button>
        
    </form>
    </div>
        
       
</nav>
           
        
        <?php   
                draw_register();
                draw_login();
         ?>
        
       
    </header>


<?php } ?>
    

<?php function draw_floating_menu() { 

?>
        
       <div id="floatingmenu"><div id ="floatingmenuheader"><h5>Hello <?php if (isset($_SESSION['username']))    
    echo $_SESSION['username'];
           else echo "Guest, you need to log in to make a post or comment";?>!</h5>
           <?php if (isset($_SESSION['username']))    {
               
     $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($_SESSION['username']));
    $result = $stmt->fetch();
               
             if($result['profileimg']!= ''){?>
           
       <p><img src="<?php echo $result['profileimg']; ?>" width=50 height = 50></p>
 <?php } ?>
          <div id = "floatingmessage"> <a href="../pages/makepost.php">Make your own post</a>
           <p>Your User Points:  <?php echo getUserPoints($_SESSION['username']); ?></p>
        </div>
                      

           <h5><?php }if (isset($_SESSION['message']))
            echo $_SESSION['message'];
                    
            unset($_SESSION['message']);
                ?></h5>
           </div>
        </div>
 

    

    
<?php } 
     
    
function draw_footer() { ?>

<div class="footer">
  <p>Copyright &#169; João Álvaro Ferreira | João Pedro Fidalgo | Simão Santos | 2018 | LTW</p>
</div>

<?php
}
    
?>

    
