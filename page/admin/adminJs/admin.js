function isValidURL(string) {
    const res = string.match(/(https?:\/\/[^\s]+)/g);
    return (res !== null);
}

function loadCurrentData(id) {
    const preview = document.getElementById('image-preview-modify');
    const filenameContainer = document.getElementById('current-image-filename'); // Assurez-vous que cet ID est correct dans votre HTML
    const imageNameSpan = document.getElementById('current-image-name'); // Nouvel élément pour le nom du fichier

    if (id) {
        setTimeout(function () {
            const xhr = new XMLHttpRequest();
            const timestamp = new Date().getTime(); // Générer un timestamp
            xhr.open('GET', 'get_entry_data.php?id=' + id + '&t=' + timestamp, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    document.getElementById('new_content').value = response.contenu;
                    document.getElementById('new_description').value = response.description;
                    document.getElementById('new_name').value = response.nom;

                    if (response.type === 'image' && response.contenu) {
                        const filename = response.contenu.split('/').pop();
                        // Afficher le nom du fichier actuel
                        console.log("response.contenu :", response.contenu);
                        if (response.contenu.startsWith('uploads/')) {

                            preview.src = './' + response.contenu;
                            console.log("URL de l'image :", preview.src);
                        } else {
                            preview.src = response.contenu;
                        }
                        preview.style.display = 'flex';

                    } else {
                        preview.style.display = 'none';
                    }
                }
            };
            xhr.send();
        }, 500);
    } else {
        document.getElementById('new_content').value = '';
        document.getElementById('new_description').value = '';
        document.getElementById('new_name').value = '';
        preview.style.display = 'none';
        filenameContainer.style.display = 'none';
        imageNameSpan.style.display = 'none'; // Masquer le nom du fichier
    }
}

function isImageUrl(url) {
    return (url.match(/\.(jpeg|jpg|gif|png|svg)$/) != null);
}

function togglePreviewOnTypeChange() {
    const type = document.getElementById('type').value;
    const preview = document.getElementById('image-preview-create');
    const imageInput = document.getElementById('imageInput');

    if (type === 'image') {
        preview.style.display = 'flex';
        imageInput.style.display = 'flex';
    } else {
        preview.style.display = 'none';
        document.getElementById('content').value = '';
        preview.src = '';
        imageInput.style.display = 'none';
    }
}

function showEditUserForm(userId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_user_data.php?id=' + userId, true);
    xhr.onload = function () {
        if (this.status === 200) {
            const response = JSON.parse(this.responseText);

            document.getElementById('user_id').value = userId;
            document.getElementById('edit_username').value = response.username;

            document.getElementById('edit-user-form').style.display = 'flex';
        }
    };
    xhr.send();
}

function updateImagePreview(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    if (input.type === 'file' && input.files && input.files[0]) {
        // Gestion de l'upload de fichier
        var reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'flex';
        }
        reader.readAsDataURL(input.files[0]);
    } else if (isValidURL(input.value)) {
        // Gestion de l'URL d'image
        preview.src = input.value;
        preview.style.display = 'flex';
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}

function loadAccueilData(id) {
    if (id) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_accueil_data.php?id=' + id, true);
        xhr.onload = function () {
            if (this.status === 200) {
                const response = JSON.parse(this.responseText);

                if (response.error) {
                    console.error(response.error);
                } else {
                    // Remplir les champs du formulaire avec les données récupérées
                    document.getElementById('titre_accueil').value = response.titre;
                    document.getElementById('description_accueil').value = response.description;
                }
            }
        };
        xhr.send();
    } else {
        // Réinitialiser les champs du formulaire
        document.getElementById('titre_accueil').value = '';
        document.getElementById('description_accueil').value = '';
    }
}