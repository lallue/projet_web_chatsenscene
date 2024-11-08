<?php
include 'bdd.php'; 

try {
    $sql = "SELECT contact, tel, adresse FROM contactEntreprise WHERE id = 1";
    $stmt = $pdo->query($sql);
    $description = $stmt->fetch(PDO::FETCH_ASSOC); 

    if ($description) {
        echo "<p><b>Contact:</b> " . htmlspecialchars($description['contact']) . "</p>";
        echo "<p><b>Tel:</b> " . htmlspecialchars($description['tel']) . "</p>";
        echo "<p><b>Adresse:</b> " . htmlspecialchars($description['adresse']) . "</p>";
    } else {
        echo "<p class='no-data'>Aucune donnée trouvée.</p>";
    }
} catch (PDOException $e) {
    echo "<p class='error-message'>Erreur lors de la récupération des données : " . $e->getMessage() . "</p>";
}