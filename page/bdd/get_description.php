<?php
include 'bdd.php';
$config = include 'config.php';

try {
    $sql = "SELECT * FROM chats";
    $stmt = $pdo->query($sql);
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="description-image-container">';

    foreach ($entries as $entry) {
        echo '<div class="entry">';

        echo '<h2>' . htmlspecialchars($entry['nom'] ?: 'Entrée sans nom') . '</h2>';

        echo '<div class="entry-content">';

        if (!empty($entry['description'])) {
            echo '<div class="description modern-description">' . htmlspecialchars($entry['description']) . '</div>';
        }

        if ($entry['type'] === 'image') {
            // Construction de l'URL de l'image pour resizeImage.php
            if (strpos($entry['contenu'], 'uploads/') === 0) {
                // Chemin relatif pour les images uploadées
                $imageUrl = $config->url . '/page/admin/' . $entry['contenu'];
            } else {
                // URL directe pour les images externes
                $imageUrl = $entry['contenu'];
            }

            // Redimensionnement des images (utiliser $imageUrl)
            $resizedImageUrl = '../../IMG/resizeImage.php?imageUrl=' . urlencode($imageUrl) . '&width=200&height=150';
            $resizedLightboxImageUrl = '../../IMG/resizeImage.php?imageUrl=' . urlencode($imageUrl) . '&width=600&height=400';

            // Affichage de l'image et de la lightbox
            echo '<div class="image-container">';
            echo '<a href="#lightbox' . $entry['id'] . '" class="lightbox-link">';
            echo '<img src="' . $resizedImageUrl . '" alt="' . htmlspecialchars($entry['description'] ?: basename($entry['contenu'])) . '" class="image" />';
            echo '</a>';
            echo '</div>';

            echo '<div id="lightbox' . $entry['id'] . '" class="lightbox">';
            echo '    <a href="#" class="close">×</a>';
            echo '    <img id="lightbox-img-' . $entry['id'] . '" data-src="' . $resizedLightboxImageUrl . '" alt="Image en grand">';
            echo '</div>';
        }

        echo '</div>'; // Fermeture de la div entry-content
        echo '</div>'; // Fermeture de la div entry
    }

    echo '</div>'; // Fermeture de la div description-image-container

} catch (PDOException $e) {
    error_log("Erreur de base de données : " . $e->getMessage());
    echo "<p>Une erreur est survenue lors de la récupération des données.</p>";
}
?>