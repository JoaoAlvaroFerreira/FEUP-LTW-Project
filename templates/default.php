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
</head>

<body>
    <div id="banner">
    <header>
        <a href="../pages/frontpage.php"><img src="images/rocket_icon.png" alt="A rocket, site icon"></a>
        <div id="forumTitle">RocketBoost</div>


    <nav id="menu">
        <ul>
            <li>hot</li>
            <li>new</li>
            <li>top</li>
        </ul>
    </nav>
    </header>
    <?php if (isset($_SESSION['message'])) {
        $message=$_SESSION['message'];
        ?>
        <section id="messages">
            <?=$message?>
        </section>
    <?php unset($_SESSION['message']); } ?>

<?php 
                                            
                                       
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
        echo '<h4><a href="../pages/makepost.php">Make your own post</a></h4>';
    }
}
?>

<?php function draw_footer() { ?>
</body>
    
</html>

<?php
}
?>

    
