<?php

require_once '../vendor/owasp/phprbac/PhpRbac/src/PhpRbac/Rbac.php';
$rbac = new PhpRbac\Rbac();


$rbac->Users->unassign(23, 105);