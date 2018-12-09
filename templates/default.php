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
        <img src="images/rocket_icon.png" alt="A rocket, site icon">
        <h1>Very Cool Forum Name</h1>
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
    <nav id="sort">
        <ul>
            <li>hot</li>
            <li>new</li>
            <li>top</li>
        </ul>
    </nav>
</body>

<?php } ?>


<?php function draw_footer() { 
?>
  </body>
</html>
<?php } ?>