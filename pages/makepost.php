<?php

include_once "../database/init.php";
include_once "../templates/auth.php";
include_once "../templates/default.php";
include_once "../database/session.php";
include_once "../database/session.php";

draw_header();

?>
    <section id="postform">
        <form action="../actions/act_add_post.php" method="post" id="userpost">Title: 
            <div id="content_form">
            <input type="text" name="title" placeholder="Give your post a title" required><br>    
            <input type="radio" name="type" value="link"> Link
            <input type="radio" name="type" value="img"> Image
            <input type="radio" name="type" value="text" checked="checked"> Text
            <input type="radio" name="type" value="video"> YouTube<br>
            <textarea name="content" placeholder="Write your post or paste your url here" form="userpost" rows="20" cols="100" required></textarea><br> 
            </div>
            Channel:<br><input type ="text" name = "channel" placeholder="Write the name of the channel that you'll post this story to" required ><br>
            <input type="submit" value="Submit" form="userpost">
            <input type="reset" form="userpost">
        </form>
    </section>
   
<?php
    
    draw_footer();

?>