<?php function draw_header() { 
?>
<!DOCTYPE html>

<html lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Very Cool Forum Name</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <header>
        <a href="../pages/frontpage.php"><img src="images/rocket_icon.png" alt="A rocket, site icon"></a>
        <h1 id="forumTitle">Very Cool Forum Name</h1>
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
   
    </nav>


<?php } ?>
    
    
<?php function draw_content() { 
?>
 <nav id="sort">
        <ul>
            <!--<li>top</li>
            <li>hot</li>-->
            <li>new</li>
            
        </ul>
     
     
                               

<?php 
         if (isset($_SESSION['username'])){
        echo '<h4><a href="../pages/makepost.php">Make your own post</a></h4>';
     }
                              } ?>

<?php function draw_footer() { 
?>
  </body>
</html>
<?php } ?>

