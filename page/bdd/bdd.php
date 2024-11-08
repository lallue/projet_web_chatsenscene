<?php
$host = 'mysql-chatsenscene.alwaysdata.net';
$dbname = 'chatsenscene_bdd';
$username = '377209_descripti';
$password = 'azktui12345%%%%#';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
