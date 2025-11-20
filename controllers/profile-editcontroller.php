<?php
requireAuth();
$user = $_SESSION['user'];

require __DIR__ . '/../views/profile.edit.view.php';
