<?php
require_once 'functions.php';

header('Content-Type: application/json'); //  Ajout de l'en-tête JSON

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $pdo = connectDatabase();

    try {
        $sql = "SELECT * FROM chats WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); //  Explicite pour la sécurité
        $stmt->execute();
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($entry) { // Vérification si un résultat a été trouvé
            echo json_encode($entry);
        } else {
            echo json_encode(['error' => 'Entrée non trouvée pour l\'ID ' . $id, 'sqlstate' => $stmt->errorCode()]); //  Plus d'infos
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erreur de base de données : ' . $e->getMessage(), 'sqlstate' => $e->getCode()]); //  Gestion des exceptions
    }
} else {
    echo json_encode(['error' => 'ID manquant.']);
}
?>