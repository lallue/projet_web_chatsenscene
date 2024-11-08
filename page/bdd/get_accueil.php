<?php
include 'bdd.php'; 

$sql = "SELECT * FROM Accueil";
$stmt = $pdo->query($sql);
$accueilEntries = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Afficher chaque entrée de la table accueil
foreach ($accueilEntries as $entry) {
    echo '<div class="accueil-entry">';
    echo '<h3>' . htmlspecialchars($entry['titre']) . '</h3>';
    echo '<p>' . htmlspecialchars($entry['description']) . '</p>';
    echo '</div>';
}
?>