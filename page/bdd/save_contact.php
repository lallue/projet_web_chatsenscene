<?php
session_start(); // Démarre une session
include 'bdd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contactPersonne (nom, prenom, email, message) VALUES (:nom, :prenom, :email, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':message' => $message
    ]);

    // Stocke le message de confirmation dans une variable de session
    $_SESSION['message'] = "Votre message a été envoyé avec succès. Merci !";

    // Redirige vers contact.php
    header("Location: ../contact.php");
    exit();
}
