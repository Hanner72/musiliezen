<?php

session_start();

require_once '../vendor/owasp/phprbac/PhpRbac/src/PhpRbac/Rbac.php';
$rbac = new PhpRbac\Rbac();

$userid = $_SESSION['USERID'];

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
}

require_once __DIR__.'/../inc/config.php';

include __DIR__.'/../inc/alert-icons.php';

include __DIR__.'/../inc/logfile-start.php';

date_default_timezone_set('Europe/Vienna');

header('Content-type: text/html; charset=UTF-8');

$CONFIG = parse_ini_file(__DIR__.'/../inc/config.ini', TRUE);