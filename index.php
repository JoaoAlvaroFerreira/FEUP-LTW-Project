<?php
  session_start();
include_once "../database/init.php";
include_once "../database/channelToXML.php";
  header('Location: pages/frontpage.php');
?>