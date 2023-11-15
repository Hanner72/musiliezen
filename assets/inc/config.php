<?php

// PFADANGABEN ##############################################

define( "DOMAIN" , 'https://musiliezen.mv-palfau.at' );                // mit "http://" ohne abschließendem Slash (/) !
define( "INSTALLORDNER" , '' );                         // ohne abschließendem Slash (/) !

// SONSTIGE EINSTELLUNGEN ###################################

define( "PREINC" , 0 );                                       // Cookies, Sessions, Files und GET anzeigen (1=ja, 0=nein)

define( "ERINNERUNGSMAIL_STPOELTEN" , 'johann.danner@strabag.com' );    // Mailadresse der die Erinnerungsmail für Lagerbestellung erhalten soll
define( "ERINNERUNGSMAIL_THALGAU" , 'florian.veleba@strabag.com' );

#############################################################



require_once 'db.php';      //die Daten für die Datenbankverbindung in der db.php eintragen!!

// AB HIER NICHTS MEHR ÄNDERN! ##############################

// mysqli Verbindung
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  mysqli_query($conn, "SET NAMES 'utf8'");

  if(!$conn)
  {
    echo "Verbindungsfehler mit Datenbank!";
  }
// / mysqli Verbindung

// pdo Verbindung
  $dboptions = array(
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  );

  try {
    $pdo = new PDO('mysql' . ':host=' . $dbhost . ';dbname=' . $dbname, $dbuser, $dbpass, $dboptions);
  } catch (Exception $ex) {
    echo $ex->getMessage();
    die;
  }

  /* try {
    $pdo2 = new PDO('mysql' . ':host=' . $dbhost2 . ';dbname=' . $dbname2, $dbuser2, $dbpass2, $dboptions);
  } catch (Exception $ex2) {
    echo $ex2->getMessage();
    die;
  } */
// / pdo Verbindung

$_SESSION["errorType"] = "";
$_SESSION["errorMsg"] = "";

//get error/success messages
if ($_SESSION["errorType"] != "" && $_SESSION["errorMsg"] != "") {
  $ERROR_TYPE = $_SESSION["errorType"];
  $ERROR_MSG = $_SESSION["errorMsg"];
  $_SESSION["errorType"] = "";
  $_SESSION["errorMsg"] = "";
}

?>