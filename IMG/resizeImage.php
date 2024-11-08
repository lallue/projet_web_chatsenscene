<?php

function resizeImageFromUrl(string $imageUrl, int $newWidth, int $newHeight): array
{
    if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
        throw new Exception("URL invalide : $imageUrl");
    }

    $imageContent = file_get_contents($imageUrl);
    if ($imageContent === false) {
        throw new Exception("Erreur de récupération de l'image.");
    }

    $image = imagecreatefromstring($imageContent);
    if ($image === false) {
        throw new Exception("Erreur de création de l'image.");
    }

    $originalWidth = imagesx($image);
    $originalHeight = imagesy($image);
    $imageInfo = getimagesizefromstring($imageContent);
    $originalFormat = $imageInfo[2];

    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

    // Gestion de la transparence pour PNG et GIF
    if (in_array($originalFormat, [IMAGETYPE_PNG, IMAGETYPE_GIF])) {
        imagealphablending($resizedImage, false);
        imagesavealpha($resizedImage, true);
        imagefill($resizedImage, 0, 0, imagecolorallocatealpha($resizedImage, 0, 0, 0, 127));
    }

    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

    ob_start();
    switch ($originalFormat) {
        case IMAGETYPE_GIF:
            imagegif($resizedImage);
            $contentType = 'image/gif';
            break;
        case IMAGETYPE_JPEG:
            imagejpeg($resizedImage, null, 60);  // Qualité par défaut pour JPEG
            $contentType = 'image/jpeg';
            break;
        default:
            imagepng($resizedImage, null, 2);  // Compression faible pour PNG
            $contentType = 'image/png';
            break;
    }
    $resizedImageContent = ob_get_clean();

    imagedestroy($image);
    imagedestroy($resizedImage);

    return ['content' => $resizedImageContent, 'contentType' => $contentType];
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['imageUrl'], $_GET['width'], $_GET['height'])) {
            throw new Exception("Paramètres manquants.");
        }

        $imageUrl = $_GET['imageUrl'];
        $width = (int)$_GET['width'];
        $height = (int)$_GET['height'];

        $resizedImageData = resizeImageFromUrl($imageUrl, $width, $height);

        header('Content-Type: ' . $resizedImageData['contentType']);
        header('Cache-Control: public, max-age=31536000');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');

        echo $resizedImageData['content'];
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
