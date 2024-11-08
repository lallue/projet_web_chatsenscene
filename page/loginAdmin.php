<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
    <script type="text/javascript" src="../js/tooglescripte.js" defer></script>
</head>

<body>
    <?php
    session_start(); // Démarrer la session
    ?>

    <header class="header-container">
        <?php include 'header.php'; ?>
    </header>

    <h1>Connexion Administrateur</h1><br />

    <!-- Affiche le message d'erreur, s'il existe -->
    <?php if (isset($_SESSION['error_message'])): ?>
        <p class="error-message"><?= htmlspecialchars($_SESSION['error_message']) ?></p>
        <?php unset($_SESSION['error_message']); // Réinitialise le message après affichage ?>
    <?php endif; ?>

    <form action="admin/login.php" method="POST"> <!-- Changez le chemin vers login.php -->
        <div class="form-group">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" class="input-field" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" class="input-field" required>
        </div>

        <button type="submit" value="Connexion" class="btn-modern">Connexion</button>
    </form>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>

</html>
