<?php
include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";





draw_header();
draw_floating_menu();


draw_error();
function draw_error(){
    ?>

    <center><h2>404 - Not found! This incident will be reported to Álvaro, João Pedro and Simão!</h2>
    <img src = "https://imgs.xkcd.com/comics/incident.png">
        <h4><a href = ../pages/frontpage.php>Click here to go back to the front page</a></h4></center>
<?php
}
?>