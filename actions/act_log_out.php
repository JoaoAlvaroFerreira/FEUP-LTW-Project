<?php
    include_once ('../database/session.php');

unset($_SESSION['username']);
$_SESSION['message'] = 'Logged out succesfully';

header('Location: ../pages/frontpage.php');
?>