<?php function draw_login() { 
?>
  <section id="login">
    
    <h3>Está nesta página como Guest, faça log in para escrever ou commentar num post. </h3>

    <form method="post" action="../actions/act_login.php">
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="submit" value="Login">
      <input type="reset">
    </form>

  </section>
<?php } ?>

<?php function draw_register() { 
?>
  <section id="register">
    
    <h3>Não está inscrito? Registe-se!</h3>

    <form method="post" action="../actions/act_register.php">
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="submit" value="Register">
      <input type="reset">
    </form>


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