<?php function draw_login() { 
?>
  <section class="user_options">
  <section id="login">
    
    <div>Login</div>

    <form method="post" action="../actions/act_login.php">
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="submit" value="Let me in!">
    </form>

  </section>
<?php } ?>

<?php function draw_register() { 
?>
  <section id="register">
    
    <div>Register</div>

    <form method="post" action="../actions/act_register.php">
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
       <input type="text" name="email" placeholder="email" required>
      <input type="submit" value="Register me!">
    </form>

  </section>
  </section>
<?php } ?>

<?php function draw_logged_in() { 
?>
  <section id="logout">
    
    <h3><?php echo "Bem vindo " . $_SESSION['username'] . "." ?></h3>
    <?php     echo '<a href = "../pages/viewProfile.php?username='.$_SESSION['username'].'">'. "Perfil" . '</a>';?>
    <a href = "../actions/act_log_out.php"> Log Out</a>

  </section>


<?php } ?>