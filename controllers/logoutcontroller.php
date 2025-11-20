<?php
session_destroy();
session_start();
$_SESSION['user'] = null;
$_SESSION['token'] = bin2hex(random_bytes(32));
header('Location: /home');
exit;