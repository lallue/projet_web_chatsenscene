# README.md - MonSiteDeChat

## Description du projet

MonSiteDeChat est un site web dédié aux chats, avec des images, des descriptions, un formulaire de contact, et un panneau d'administration pour gérer le contenu.

## Technologies utilisées

* **Frontend:** HTML, CSS (Flexbox), JavaScript, AJAX, JSON, XML
* **Backend:** PHP, MySQL (PDO)

## Fonctionnalités

* Affichage dynamique d'images de chats sur la page d'accueil.
* Page de description avec des images et du texte.
* Formulaire de contact.
* Panneau d'administration pour :
    * Gérer les entrées de la page d'accueil (titre, description, image/URL).
    * Gérer les messages du formulaire de contact.
    * Gérer les utilisateurs.

## Installation en local

1. **Installer un serveur web local:**  WAMP (Windows), MAMP (macOS), ou LAMP (Linux).
2. **Créer une base de données MySQL :**  Utilisez phpMyAdmin ou un autre outil de gestion de base de données.
3. **Importer la structure de la base de données :** Importez le fichier SQL de création de la table `chats`, `Accueil`, `utilisateur`, et `contactPersonne`. Adaptez les noms de colonnes et de tables si nécessaire.
4. **Configurer la connexion à la base de données :** Modifiez les paramètres de connexion dans le fichier `bdd.php` pour qu'ils correspondent à votre configuration locale.
5. **Copier les fichiers du projet :**  Copiez tous les fichiers du projet dans le dossier racine de votre serveur web local.
6. **Créer le dossier "uploads" :** Créez un dossier nommé "uploads" à la racine de votre site pour stocker les images. Assurez-vous que le dossier a les permissions d'écriture pour le serveur web.
7. **Ajuster les chemins relatifs :**  Vérifiez et corrigez tous les chemins relatifs dans le code HTML, CSS, JavaScript et PHP en fonction de votre configuration locale.
8. **Accéder au site web :** Ouvrez votre navigateur web et accédez à l'URL de votre site web local (par exemple, `http://localhost/MonSiteDeChat/`).

## Remarques

* Ce README est un exemple et doit être adapté à votre projet spécifique.
* N'oubliez pas d'ajouter des informations sur l'auteur, la licence, etc.
* Vous pouvez également inclure des instructions pour l'installation des dépendances, la configuration du serveur, etc.