<?php
$dsn = 'mysql:dbname=wizardfactory;port=3306;host=localhost';
$user = 'root';
$password = 'root';

try {
    $connection = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    exit('Connexion échouée : ' . $e->getMessage());
}
