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
    <link rel="icon" href="..//pages/images/rocket_icon.png">
    <script src="../js/script.js" defer></script>
</head>

<body>
    <header id="logo_tabmenu">       
    <div><a href="../pages/frontpage.php"><img src="images/logo.png" alt="A rocket, site icon"></a></div>
    <nav class="nav">
    <ul>
        <li>
            <a href="#">About</a></li>
        <li>
            <a href="#">Stories</a>
            <ul>
                <li><a href="../pages/frontpage.php?sort=points">Sort by Votes</a></li>
                <li><a href="../pages/frontpage.php?sort=new">Sort by New</a></li>
                <li><a href="../pages/frontpage.php?sort=comments">Sort by Comments</a></li>
            </ul>
        </li>
        <li>
            <a href="#">User</a>
            <ul>
                <li><a href="#">User List</a></li>
               
                <?php if(isset($_SESSION['username'])){ ?>
               <li><a href="../pages/viewProfile.php?username=<?php echo $_SESSION['username']?>">Your Profile</a></li>
               <li> <a href = "../actions/act_log_out.php"> Log Out</a></li>
               <?php }else{ ?>
               <li><a onclick="document.getElementById('register').style.display='block'">Register</a></li>
                <li><a onclick="document.getElementById('login').style.display='block'">Log In</a></li>
                <?php }?>
            </ul>
        </li>
    </ul>
</nav>
        
        
        
        <?php draw_login();
            draw_register();?>
    </header>
   
     

<?php 
                                            
                                       

    
?>


    


<?php } ?>
    

<?php function draw_floating_menu() { 

     ?>
        
       <div id="floatingmenu"><div id ="floatingmenuheader"><h5>Hello <?php if (isset($_SESSION['username']))    
    echo $_SESSION['username'];
           else echo "Guest, you need to log in to make a post or comment";?>!</h5>
           <?php if (isset($_SESSION['username']))    { ?>
           <a href="../pages/makepost.php">Make your own post</a> 
           <h5><?php }if (isset($_SESSION['message']))
            echo $_SESSION['message'];
                    
                                      unset($_SESSION['message']);
                ?></h5></div></div>
   <?php 

?>
<script>
    // Make the DIV element draggable:
window.onload = function(){
    dragElement(document.getElementById("floatingmenu"));
    

function dragElement(elmnt) {
    console.log(elmnt)
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV: 
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
}</script>

<?php} function draw_footer() { ?>

<div class="footer">
  <p>Copyright &#169; João Álvaro Ferreira | João Pedro Fidalgo | Simão Santos | 2018 | LTW</p>
</div>


    


<?php
}
?>

    
