<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Page d'accueil du site" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print">
    <script type="text/javascript" src="js/script.js" defer></script>
    <script type="text/javascript" src="js/tooglescripte.js" defer></script>
</head>

<body>
    <header class="header-container">
        <?php include 'page/header.php'; ?>
    </header>

    <?php include 'page/bdd/get_accueil.php'; ?>

    <div id="image-viewer">
        <img id="dynamic-image" src="" alt="Image en cours de chargement..." />
        <button id="prev-button">⬅</button>
        <button id="next-button">⮕</button>
    </div>

    <footer>
        <?php include 'page/footer.php'; ?>
    </footer>
</body>

</html>