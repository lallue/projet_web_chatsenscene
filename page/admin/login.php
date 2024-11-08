<?php
session_start();
require_once 'functions.php'; // Inclure le fichier functions.php

// Vérifie si les champs du formulaire sont bien remplis
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $passwordInput = $_POST['password'];

    // Appel de la fonction login
    $loginResult = login($username, $passwordInput);
    
    if (is_array($loginResult) && $loginResult['success'] === true) {
        // Identifiants corrects : démarre la session
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['user_id'] = $loginResult['user']['id'];

        // Code JavaScript pour mettre à jour le bouton (déplacé ici)
        echo '<script>
            document.getElementById("admin-login").onclick = function() {
                window.location.href = "../../page/admin/admin.php";
            };
        </script>';

        header('Location: admin.php'); // Redirection vers le panneau admin
        exit();
    } elseif ($loginResult === false) {
        // Si le résultat est false, déterminer si c'est un problème de nom d'utilisateur ou de mot de passe
        // Vérification pour le message d'erreur approprié
        $pdo = connectDatabase();
        $sql = "SELECT * FROM utilisateur WHERE utilisateur = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Si l'utilisateur existe mais que le mot de passe est incorrect
            $_SESSION['error_message'] = "Mot de passe incorrect.";
        } else {
            // Si l'utilisateur n'existe pas
            $_SESSION['error_message'] = "Nom d'utilisateur incorrect.";
        }

        header('Location: ../loginAdmin.php'); // Redirection vers la page de connexion
        exit();
    }
} else {
    // Champs non remplis
    $_SESSION['error_message'] = "Veuillez remplir tous les champs de connexion.";
    header('Location: ../loginAdmin.php'); // Redirection vers la page de connexion
    exit();
}
?>