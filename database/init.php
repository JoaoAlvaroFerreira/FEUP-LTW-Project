<?php
  session_start();
  function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
  if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = generate_random_token();
  }
?>