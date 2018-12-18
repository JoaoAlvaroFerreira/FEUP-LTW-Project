<?php

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../templates/post.php";

draw_header();

$id = $_GET['id'];
draw_post($id);
draw_comments($id, 0,0);
draw_floating_menu();
draw_footer();
?>