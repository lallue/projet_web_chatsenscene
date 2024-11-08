<?php session_start(); // Démarre une session ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script type="text/javascript" src="../js/tooglescripte.js" defer></script>
    <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
</head>

<body>
    <header class="header-container">
        <?php include 'header.php'; ?>
    </header>

    <main class="contact-main">
        <div class="contact-left">
            <h1 class="contact-title">Remplissez le formulaire pour toute demande<br /> Nous vous contacterons bientôt</h1>

            <!-- Affichage du message de confirmation -->
            <?php if (isset($_SESSION['message'])): ?>
                <p class="confirmation-message"><?php echo $_SESSION['message']; ?></p>
                <?php unset($_SESSION['message']); // Supprime le message après l'avoir affiché ?> 
            <?php endif; ?>

            <!-- Formulaire de contact -->
            <form id="contact-form" action="bdd/save_contact.php" method="POST" class="contact-form">
                <div class="input-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" class="input-field" required>
                </div>

                <div class="input-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" class="input-field" required>
                </div>

                <div class="input-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" class="input-field" required>
                </div>

                <div class="input-group">
                    <label for="message">Message :</label>
                    <textarea id="message" name="message" class="textarea-field" rows="5" required></textarea>
                </div>

                <button type="submit" value="Envoyer" class="btn-modern">Envoyer</button>
            </form>
        </div>

        <div class="contact-info">
            <h2>Contactez nous</h2>
            <?php include 'bdd/get_contact.php'; ?>
        </div>
    </main>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

</html>