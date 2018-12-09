<?php function draw_login() { 
?>
  <section id="login">
    
    <header><h3>Está nesta página como Guest, faça log in para escrever ou commentar num post. </h3></header>

    <form method="post" action="../actions/act_login.php">
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="submit" value="Login">
    </form>

  </section>
<?php } ?>

<?php function draw_register() { 
?>
  <section id="register">
    
    <header><h3>Não está inscrito? Registe-se!</h3></header>

    <form method="post" action="../actions/act_register.php">
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="submit" value="Register">
    </form>


  </section>
<?php } ?>

<?php function draw_logged_in() { 
?>
  <section id="logout">
    
    <header><h3><?php echo "Bem vindo " . $_SESSION['username'] . "." ?></h3></header>

   <a href = "../pages/profile.php"> Perfil</a>
    <a href = "../actions/act_log_out.php"> Log Out</a>
      
   


  </section>
<?php } ?>