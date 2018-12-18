<?php

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";

draw_header();
draw_footer();

?>
    <section id = "postform">
        <form action="../actions/act_add_post.php" method="post" id="userpost">Title: 
            <input type="text" name="title" placeholder="Give your post a title">     
            <input type="radio" name="type" value="link"> Link
            <input type="radio" name="type" value="img"> Image
            <input type="radio" name="type" value="text" checked="checked"> Text
            <input type="radio" name="type" value="video"> YouTube
            <textarea name="content" placeholder="Write your post or paste your url here" form="userpost" rows="20" cols="100"></textarea> 
            <input type="submit" value="Submit" form="userpost">
            <input type="reset" form="userpost">
        </form>
    </section>
   
<?php
    
    draw_footer();

?>
    