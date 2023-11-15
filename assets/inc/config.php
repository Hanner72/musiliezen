<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_start();
session_start();


// SERVER
define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'mvpalfau_musiliezen');
define('DB_SERVER_PASSWORD', 'oF8NIYOi7s!');
define('DB_DATABASE', 'mvpalfau_musiliezen');

//LOCALHOST
/* define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE', 'mvverwaltung'); */


define('PROJECT_NAME', '#musicapo - Die Musikvereinsverwaltung');
define('PROJECT_NAME_KURZ', '#musicapo');
define('PROJECT_NAME_FIRST', 'MUSI'); // Topmenu Überschrift Farbe 1
define('PROJECT_NAME_SECOND', 'CAPO'); // Topmenu Überschrift Farbe 2

$dboptions = array(
              PDO::ATTR_PERSISTENT => false,
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
              PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );

try {
    $DB = new PDO(DB_DRIVER.':host='.DB_SERVER.';dbname='.DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
    echo $ex->getMessage();
    die;
}

//get error/success messages
if ($_SESSION["errorType"] != "" && $_SESSION["errorMsg"] != "") {
    $ERROR_TYPE = $_SESSION["errorType"];
    $ERROR_MSG = $_SESSION["errorMsg"];
    $_SESSION["errorType"] = "";
    $_SESSION["errorMsg"] = "";
}