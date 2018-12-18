<?php

include_once('init.php');

header("Content-type: text/xml");

$dbhandle = sqlite_open('sqlitedb');
$query    = sqlite_query($dbhandle, 'SELECT channel FROM posts');
$result   = sqlite_fetch_all($query, SQLITE_ASSOC);

$db = Database::getInstance()->db();
$query = $db->prepare("SELECT * FROM posts group by channel");
$query->execute();
$result = $query->fetchAll();

$xml_output  = "<?xml version=\"1.0\"?>\n";
$xml_output .= "<entries>\n";

foreach ($result as $row) {
    $xml_output .= "\t<entry>\n";
  
    $row['channel'] = str_replace("&", "&", $row['channel']);
    $row['channel'] = str_replace("<", "<", $row['channel']);
    $row['channel'] = str_replace(">", "&gt;", $row['channel']);
    $row['channel'] = str_replace("\"", "&quot;", $row['channel']);
    $xml_output .= "\t\t<channel>" . $row['channel'] . "</channel>\n";
    $xml_output .= "\t</entry>\n";
}

$xml_output .= "</entries>";
$db = null;
?>