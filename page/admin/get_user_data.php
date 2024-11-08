<?php
require_once 'functions.php';

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    $pdo = connectDatabase();
    $sql = "SELECT utilisateur FROM utilisateur WHERE id = :userId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $username = $stmt->fetchColumn();

    if ($username !== false) {
        echo json_encode(['username' => $username]);
    } else {
        echo json_encode(['username' => '']); 
    }
} else {
    echo json_encode(['username' => '']);
}
?>