<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
    <script type="text/javascript" src="../js/tooglescripte.js"></script>
</head>

<body>
    <header class="header-container">
        <?php include 'header.php'; ?>
    </header>

    <h1>Description</h1>
    <div class="modern-description" >
        <?php include 'bdd/get_description.php'; ?>
    </div>
</body>
<footer>
    <?php include 'footer.php' ?>
</footer>

</html>