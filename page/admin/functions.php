<?php
function connectDatabase()
{
    $host = 'mysql-chatsenscene.alwaysdata.net';
    $dbname = 'chatsenscene_bdd';
    $user = '377209';
    $password = 'azktui12345%%%%#';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

function login($username, $passwordInput)
{
    $pdo = connectDatabase();

    $sql = "SELECT * FROM utilisateur WHERE utilisateur = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($passwordInput, $user['password'])) {
            return ['success' => true, 'user' => $user];
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function deleteUser($userId)
{
    $pdo = connectDatabase();

    $sql = "DELETE FROM utilisateur WHERE id = :userId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':userId' => $userId
    ]);
}

function updateUser($userId, $newUsername, $newPassword)
{
    $pdo = connectDatabase();

    $sql = "UPDATE utilisateur SET utilisateur = :username";
    $params = [':username' => $newUsername, ':userId' => $userId];

    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql .= ", password = :password";
        $params[':password'] = $hashedPassword;
    }

    $sql .= " WHERE id = :userId";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
}

function createEntry($name, $content, $image_upload, $description)
{
    $pdo = connectDatabase();
    $type = "image";

    if (isset($image_upload) && $image_upload['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($image_upload['name']);

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($image_upload['tmp_name'], $uploadFile)) {
                $content = $uploadFile;
                $type = "image";
            } else {
                echo "Erreur lors de l'upload de l'image.";
            }
        } else {
            echo "Type de fichier non autorisé.";
        }
    } else if (filter_var($content, FILTER_VALIDATE_URL) && isImageUrl($content)) {
        $type = "image";
    }

    $sql = "INSERT INTO chats (nom, type, contenu, description) VALUES (:nom, :type, :contenu, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $name );
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':contenu', $content); // Ajouté pour la colonne "contenu"
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {
        return $pdo->lastInsertId();
    } else {
        echo "Erreur lors de l'insertion de l'entrée.";
        return false;
    }
}


function updateEntry($id_to_update, $new_content, $new_image_upload, $new_description, $new_name)
{
    $pdo = connectDatabase();

    if (isset($new_image_upload) && $new_image_upload['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($new_image_upload['name']);

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($new_image_upload['tmp_name'], $uploadFile)) {
                $new_content = $uploadFile;
            } else {
                echo "Erreur lors du téléchargement de la nouvelle image.";
                return;
            }
        } else {
            echo "Type de fichier non autorisé.";
            return;
        }
    }

    $type = (filter_var($new_content, FILTER_VALIDATE_URL) && isImageUrl($new_content)) ? "image" : "image";

    $sql = "UPDATE chats SET nom = :nom, type = :type, contenu = :contenu, description = :description WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $new_name , PDO::PARAM_STR);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':contenu', $new_content);
    $stmt->bindParam(':description', $new_description);
    $stmt->bindParam(':id', $id_to_update, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Entrée mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de l'entrée.";
    }
}
function deleteAccueilEntry($id)
{
    $pdo = connectDatabase();

    $sql = "DELETE FROM Accueil WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Entrée supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'entrée.";
    }
}

function getChatEntries()
{
    $pdo = connectDatabase();
    $sql = "SELECT id, nom, type, contenu, description FROM chats";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getContactEntries()
{
    $pdo = connectDatabase();
    $sql = "SELECT id, nom, prenom, email, message FROM contactPersonne";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteContactEntry($id)
{
    $pdo = connectDatabase();
    $sql = "DELETE FROM contactPersonne WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function deleteEntry($id)
{
    $pdo = connectDatabase();

    // 1. Récupérer le chemin de l'image à supprimer
    $sql = "SELECT contenu FROM chats WHERE id = :id AND type = 'image'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $imagePath = $stmt->fetchColumn();

    // 2. Supprimer l'entrée de la base de données
    $sql = "DELETE FROM chats WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 3. Supprimer l'image si elle existe
    if ($imagePath && file_exists($imagePath)) {
        unlink($imagePath);
    }
}

function createUser($username, $password)
{
    $pdo = connectDatabase();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilisateur (utilisateur, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashedPassword
    ]);
}

function createAccueilEntry($titre, $description)
{
    $pdo = connectDatabase();

    $sql = "INSERT INTO Accueil (titre, description) VALUES (:titre, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {
        echo "Entrée créée avec succès.";
    } else {
        echo "Erreur lors de la création de l'entrée.";
    }
}

function updateAccueilEntry($id, $titre, $description)
{
    $pdo = connectDatabase();

    $sql = "UPDATE Accueil SET titre = :titre, description = :description WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Entrée mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de l'entrée.";
    }
}
function getAccueilEntries()
{
    $pdo = connectDatabase();
    $sql = "SELECT * FROM Accueil";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUsers()
{
    $pdo = connectDatabase();
    $users = $pdo->query("SELECT id, utilisateur FROM utilisateur")->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../loginAdmin.php');
    exit();
}

function isImageUrl($url)
{
    $imgExts = array("gif", "jpg", "jpeg", "png", "tiff", "tif");
    $urlExt = strtolower(pathinfo($url, PATHINFO_EXTENSION));
    return in_array($urlExt, $imgExts);
}
