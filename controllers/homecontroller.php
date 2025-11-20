<?php
require_once __DIR__ . '/../models/books.php';

$books = getAllBooks($db);
require __DIR__ . '/../views/home.view.php';