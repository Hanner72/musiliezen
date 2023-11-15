<?php
// Initialize the session.
session_start();

require_once './assets/inc/config.php';

// include './assets/inc/logfile-start.php';
// $level = INFO; $message = $_SESSION['user'].' - hat sich ausgeloggt'; include './assets/inc/logfile-end.php';

// Unset all of the session variables.
unset($_SESSION['user']);
unset($_SESSION['firstlogin']);
// Finally, destroy the session.    
session_destroy();

// Include URL for Login page to login again.
header("Location: index.php");
exit;

?>