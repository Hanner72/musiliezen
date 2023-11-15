<?php

/* $dbhost2 = "85.10.231.134";
$dbuser2 = "zeitstra_app";
$dbpass2 = "usNLrRWD49JK";
$dbname2 = "zeitstra_kimai2"; */

$dbhost2 = "localhost";
$dbuser2 = "root";
$dbpass2 = "";
$dbname2 = "wwzz";

$conn2 = mysqli_connect($dbhost2, $dbuser2, $dbpass2, $dbname2);
mysqli_query($conn2, "SET NAMES 'utf8'");

if(!$conn2)
{
  echo "Verbindungsfehler mit Datenbank!";
}

?>