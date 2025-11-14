<?php

function readGenres(PDO $db): array {
    $stmt = $db->query("SELECT genre FROM genres;");
    return $stmt->fetchAll();
}
