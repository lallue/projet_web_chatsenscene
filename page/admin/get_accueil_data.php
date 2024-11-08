<?php
require_once 'functions.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $pdo = connectDatabase();
    $sql = "SELECT * FROM Accueil WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $accueilData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($accueilData) {
        echo json_encode($accueilData);
    } else {
        echo json_encode(['error' => 'Entrée non trouvée.']);
    }
} else {
    echo json_encode(['error' => 'ID manquant.']);
}
?>