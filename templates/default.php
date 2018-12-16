<?php function draw_header() { 
?>
<!DOCTYPE html>

<html lang="en-US">

<head>
    <meta charset="utf-8">
    <title>RocketBoost</title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="icon" href="..//pages/images/fire_icon.png">
</head>

<body>
    <div id="banner">
    <header id="logo_tabmenu">
        <div id="logo_title">
        <a href="../pages/frontpage.php"><img src="images/rocket_icon.png" alt="A rocket, site icon"></a>
        <div id="forum_title">RocketBoost</div>
        </div>
        
        <nav id="menu">
            <li><a class="active">hot</a></li>
            <li><a>new</a></li>
            <li><a>top</a></li>
        </nav>
    </header>

<?php 
                                       
    include_once "../templates/auth.php";
 
    if (isset($_SESSION['message'])){
        
        echo $_SESSION['message'];
    }
                                                 
                                       
   if (!isset($_SESSION['username'])){
        
       draw_login();
       
       draw_register();
    }
                                       
        
    else draw_logged_in();
    
?>

</div>
    


<?php } ?>
    

<?php function draw_content() { 

    if (isset($_SESSION['username'])){
        echo '<div class="site_message"><a href="../pages/makepost.php">Make your own post</a></div>';
    }
}
?>

<?php function draw_footer() { ?>

<div class="footer">
  <p>Copyright &#169; João Álvaro Ferreira | João Pedro Fidalgo | Simão Santos | 2018 | LTW</p>
</div>

</body>
    
</html>

<?php
}
?>

    
