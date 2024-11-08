<?php
session_start();
require_once 'functions.php';
// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../loginAdmin.php');
    exit();
}
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Vérifie si l'utilisateur est l'administrateur principal (ID 1)
$isAdmin = ($_SESSION['user_id'] == 1);

// Gestion des actions de création, mise à jour et suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $content = $_POST['content'];
        $description = $_POST['description']; // Récupérer la description
        $image_upload = $_FILES['image_upload'];
        $new_id = createEntry($name, $content, $image_upload, $description);
        echo "<p>Nouvelle ligne ajoutée avec succès (ID: $new_id) !</p>";
    } elseif (isset($_POST['update'])) {
        $id_to_update = $_POST['id_to_update'];
        $new_content = $_POST['new_content'];
        $new_description = $_POST['new_description'];
        $new_image_upload = $_FILES['new_image_upload'];
        $new_name = $_POST['new_name']; // Récupérer le nouveau nom
        updateEntry($id_to_update, $new_content, $new_image_upload, $new_description, $new_name);
        echo "<p>Description mise à jour avec succès pour l'ID: $id_to_update !</p>";
    } elseif (isset($_POST['delete_contact'])) {
        $id_to_delete_contact = $_POST['id_to_delete_contact'];
        deleteContactEntry($id_to_delete_contact);
        echo "<p>Contact supprimé avec succès (ID: $id_to_delete_contact) !</p>";
    } elseif (isset($_POST['delete'])) {
        $id_to_delete = $_POST['id_to_update'];
        deleteEntry($id_to_delete);
        echo "<p>Ligne supprimée avec succès (ID: $id_to_delete) !</p>";
    } elseif (isset($_POST['create_user'])) {
        if ($isAdmin) {
            $username = $_POST['new_username'];
            $password = $_POST['new_password'];
            createUser($username, $password);
            echo "<p>Nouvel utilisateur créé avec succès !</p>";
        }
    } elseif (isset($_POST['update_user'])) {
        if ($isAdmin) {
            $userId = $_POST['user_id'];
            $newUsername = $_POST['edit_username'];
            $newPassword = $_POST['edit_password'];
            updateUser($userId, $newUsername, $newPassword);
            echo "<p>Utilisateur mis à jour avec succès !</p>";
        }
    } elseif (isset($_POST['delete_user'])) {
        if ($isAdmin) {
            $userId = $_POST['user_to_delete'];
            if ($userId != 1) {
                deleteUser($userId);
                echo "<p>Utilisateur supprimé avec succès !</p>";
            } else {
                echo "<p>Impossible de supprimer l'administrateur principal.</p>";
            }
        }
    } elseif (isset($_POST['create_accueil'])) {
        if ($isAdmin) {
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            createAccueilEntry($titre, $description);
            // Recharger les entrées après la création
            $accueilEntries = getAccueilEntries();
        }
    } elseif (isset($_POST['update_accueil'])) {
        if ($isAdmin) {
            $id = $_POST['accueil_id'];
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            updateAccueilEntry($id, $titre, $description);
            // Recharger les entrées après la modification
            $accueilEntries = getAccueilEntries();
        }
    } elseif (isset($_POST['delete_accueil'])) {
        if ($isAdmin) {
            $id = $_POST['accueil_id'];
            deleteAccueilEntry($id);
            // Recharger les entrées après la suppression
            $accueilEntries = getAccueilEntries();
        }
    } elseif (isset($_POST['logout'])) {
        logout();
    }
}

// Récupération des entrées de la base de données
$chats = getChatEntries();
$contacts = getContactEntries();
$users = getUsers();
$accueilEntries = getAccueilEntries();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gestion des entrées</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/styleAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/print.css" media="print">
    <script type="text/javascript" src="adminJs/admin.js" defer></script>
</head>

<body>
    <h1>Gestion des entrées</h1>
    <div id="image-path"></div>
    <div class="form-container">
        <!-- Formulaire pour ajouter une nouvelle entrée -->
        <div class="admin-form">
            <h2 class="form-title">Ajouter une nouvelle entrée</h2>
            <form action="admin.php" method="POST" enctype="multipart/form-data">
                <label for="name">Nom (optionnel):</label>
                <input type="text" name="name" id="name" class="input-field">

                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="5" class="textarea-field"></textarea>

                <label for="content">Contenu (URL d'image):</label>
                <textarea name="content" id="content" rows="5" class="textarea-field" onblur="updateImagePreview('content', 'image-preview-create')"></textarea>

                <div class="image-preview-container">
                    <img id="image-preview-create" src="#" alt="Aperçu de l'image" class="image-preview">
                </div>
                <label for="image_upload">Changer l'image: </label>
                <input type="file" name="image_upload" id="image_upload" accept="image/*" onchange="updateImagePreview('image_upload', 'image-preview-create')">

                <button type="submit" name="create" value="Créer une nouvelle ligne" class="btn-modern">Créer une nouvelle ligne</button>
            </form>
        </div>

        <!-- Formulaire pour modifier une entrée existante -->
        <div class="admin-form">
            <h2 class="form-title">Modifier une entrée existante</h2>
            <form action="admin.php" method="POST" enctype="multipart/form-data">
                <label for="id_to_update">Sélectionner l'entrée à modifier :</label>
                <select name="id_to_update" id="id_to_update" class="input-field" onchange="loadCurrentData(this.value)" required>
                    <option value="">-- Sélectionner une entrée --</option>
                    <?php foreach ($chats as $chat): ?>
                        <option value="<?php echo $chat['id']; ?>">
                            <?php echo htmlspecialchars($chat['nom'] ?: 'Entrée sans nom'); ?> (ID: <?php echo $chat['id']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="new_name">Nom :</label> <!--  Nouveau label -->
                <input type="text" name="new_name" id="new_name" class="input-field">

                <label for="new_description">Description:</label>
                <textarea name="new_description" id="new_description" rows="5" class="textarea-field"></textarea>

                <label for="new_content">Contenu (URL d'image):</label>
                <textarea name="new_content" id="new_content" rows="5" class="textarea-field" onblur="updateImagePreview('new_content', 'image-preview-modify')"></textarea>

                <span id="current-image-filename"></span>
                <div class="image-preview-container">
                    <img id="image-preview-modify" src="#" alt="Aperçu de l'image" class="image-preview">
                </div>

                <label for="new_image_upload">Changer l'image: </label>
                <input type="file" name="new_image_upload" id="new_image_upload" accept="image/*" onchange="updateImagePreview('new_image_upload', 'image-preview-modify')">

                <button type="submit" name="update" value="Modifier l'entrée" class="btn-modern">Modifier l'entrée</button>
                <button type="submit" name="delete" value="Supprimer l'entrée" class="btn-modern" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entrée ?')">Supprimer</button>
            </form>
        </div>

        <!-- Formulaire pour gérer les contacts -->
        <div class="admin-form">
            <h2 class="form-title">Contacts</h2>
            <div class="scrollable-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($contact['id']); ?></td>
                                <td><?php echo htmlspecialchars($contact['nom']); ?></td>
                                <td><?php echo htmlspecialchars($contact['prenom']); ?></td>
                                <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                <td><?php echo htmlspecialchars($contact['message']); ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id_to_delete_contact" value="<?php echo $contact['id']; ?>">
                                        <button type="submit" value="Supprimer" name="delete_contact" class="btn-modern">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Formulaire pour la gestion des utilisateurs (visible uniquement pour l'admin) -->
    <?php if ($isAdmin): ?>
        <div class="form-container">
            <div class="admin-form">
                <h2 class="form-title">Créer un nouvel utilisateur</h2>
                <form action="admin.php" method="POST">
                    <label for="new_username">Nom d'utilisateur :</label>
                    <input type="text" name="new_username" id="new_username" required class="input-field">

                    <label for="new_password">Mot de passe :</label>
                    <input type="password" name="new_password" id="new_password" required class="input-field">

                    <button type="submit" name="create_user" value="Créer l'utilisateur" class="btn-modern">Créer l'utilisateur</button>
                </form>
            </div>

            <div class="admin-form" style="width: 100%;">
                <h2 class="form-title">Gestion des utilisateurs</h2>
                <div class="scrollable-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom d'utilisateur</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $user):
                                if ($user['id'] != 1): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['utilisateur']); ?></td>
                                        <td>
                                            <button type="button" name="modify_user" class="btn-modern" onclick="showEditUserForm(<?php echo $user['id']; ?>)">Modifier</button>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="user_to_delete" value="<?php echo $user['id']; ?>">
                                                <button type="submit" name="delete_user" value="Supprimer" class="btn-modern" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette utilisateur ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Formulaire de modification (masqué par défaut) -->
                <div id="edit-user-form" style="display: none;">
                    <h2 class="form-title">Modifier un utilisateur</h2>
                    <form action="admin.php" method="POST" id="edit-user-form">
                        <input type="hidden" name="user_id" id="user_id">
                        <label for="edit_username">Nom d'utilisateur :</label>
                        <input type="text" name="edit_username" id="edit_username" required class="input-field">

                        <label for="edit_password">Nouveau mot de passe (laisser vide pour ne pas modifier) :</label>
                        <input type="password" name="edit_password" id="edit_password" class="input-field">

                        <button type="submit" name="update_user" value="Enregistrer les modifications" class="btn-modern">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>


            <div class="admin-form">
                <h2 class="form-title">Créer une entrée pour l'accueil</h2>
                <form action="admin.php" method="POST">
                    <label for="titre">Titre :</label>
                    <input type="text" name="titre" id="titre" class="input-field">

                    <label for="description">Description :</label>
                    <textarea name="description" id="description" rows="5" class="textarea-field"></textarea>

                    <button type="submit" name="create_accueil" value="Créer" class="btn-modern">Créer</button>
                </form>
            </div>

            <!-- Formulaire pour modifier une entrée de l'accueil -->
            <div class="admin-form">
                <h2 class="form-title">Modifier une entrée de l'accueil</h2>
                <form action="admin.php" method="POST">
                    <label for="accueil_id">Sélectionner l'entrée à modifier :</label>
                    <select name="accueil_id" id="accueil_id" class="input-field" onchange="loadAccueilData(this.value)" required>
                        <option value="">-- Sélectionner une entrée --</option>
                        <?php foreach ($accueilEntries as $entry): ?>
                            <option value="<?php echo $entry['id']; ?>" <?php if (isset($_POST['accueil_id']) && $_POST['accueil_id'] == $entry['id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($entry['titre'] ?: 'Entrée sans titre'); ?> (ID: <?php echo $entry['id']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="titre_accueil">Titre :</label>
                    <input type="text" name="titre" id="titre_accueil" value="<?php echo isset($_POST['titre']) ? htmlspecialchars($_POST['titre']) : ''; ?>" class="input-field">

                    <label for="description_accueil">Description :</label>
                    <textarea name="description" id="description_accueil" rows="5" class="textarea-field"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>

                    <button type="submit" name="update_accueil" value="Modifier" class="btn-modern">Modifier</button>
                    <button type="submit" name="delete_accueil" value="Supprimer" class="btn-modern" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette ligne?')">Supprimer</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <form method="POST">
        <button type="submit" value="Se déconnecter" name="logout" class="btn-modern">Se déconnecter</button>
    </form>

    <form>
        <p><a href="../../index.php">Retour à l'accueil</a></p>
    </form>

</body>

</html>