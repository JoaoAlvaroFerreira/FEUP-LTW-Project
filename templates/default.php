<?php
    include_once "../templates/auth.php";
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
    <script src="../js/script.js" defer></script>
</head>

<body>
    <header id="logo_tabmenu">       
    <div id="logo"><a href="../pages/frontpage.php"><img src="images/logo.png" alt="A rocket, site icon"></a></div>
    <nav class="nav">
    <ul>
        <li>
            <a href="#">About</a></li>
        <li>
            <a href="#">Sort By</a>
            <ul>
                <li><a href="../pages/frontpage.php?sort=points">Most Voted</a></li>
                <li><a href="../pages/frontpage.php?sort=new">Most Recent</a></li>
                <li><a href="../pages/frontpage.php?sort=comments">Most Comments</a></li>
            </ul>
        </li>
        <li>
            <a href="#">User</a>
            <ul>
                <li><a href="#">User List</a></li>
               
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
</nav>
        </div>
        <?php 
            draw_login();
            draw_register();
        ?>
</header>
    <?php if (isset($_SESSION['message'])) {
        $message=$_SESSION['message'];
        unset($_SESSION['message']); 
    }
} ?>    

<?php function draw_floating_menu() { 
    if (isset($_SESSION['username'])){ ?>
       <div class="floating_menu">
            <div id="floating_message">
               Hello <?php echo $_SESSION['username']?>!
            </div>
            <a href="../pages/makepost.php">Make your own post!</a>
        </div>
   <?php }
}
?>

<?php function draw_footer() { ?>

<div class="footer">
  <span>Copyright &#169; João Álvaro Ferreira | João Pedro Fidalgo | Simão Santos | 2018 | LTW</span>
</div>

</body>
    
</html>

<?php
}
?>

    
