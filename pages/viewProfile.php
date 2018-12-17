<?php

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/profile.php";

draw_header();
$username = $_GET['username'];
draw_user_info($username);
draw_user_posts($username);
draw_floating_menu();



?>