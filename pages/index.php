<?php

include_once "../database/init.php";
?>

<!DOCTYPE html>

<html lang="en-US">

<head>
    <title>Very Cool Forum Name</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <header>
        <img src="images/rocket_icon.png" alt="A rocket, site icon">
        <h1>Very Cool Forum Name</h1>
        <?php
        
         if (!isset($_SESSION['username']))
        echo "Esta nesta página como Guest, faça log in para ler um post.";
        
        else echo "Bem vindo " . $_SESSION['username'] . ".<br>";
        ?>
        
    </header>
    <nav id="sort">
        <ul>
            <li>hot</li>
            <li>new</li>
            <li>top</li>
        </ul>
    </nav>
</body>
    
            <?php
        include "../pages/misc/sign_up.php";
    
    echo "espaco";
    include "../pages/misc/sign_in.php";
        ?>



</html>