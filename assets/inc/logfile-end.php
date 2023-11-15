<?php

$sqllog = $pdo->prepare("INSERT INTO logging (level, message) VALUES (?, ?)");
$sqllog->execute(array($level, $message));