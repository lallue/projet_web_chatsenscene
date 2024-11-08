function toggleMenu() {
    const navCenter = document.querySelector('.nav-center');
        const burger = document.querySelector('.burger');
        navCenter.classList.toggle('active');
        burger.classList.toggle('active');
}

// tooglescripte.js

document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll('.input-field, .textarea-field');

    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            const label = this.parentElement.querySelector('label');
            if (label) {
                label.classList.add('label-focus');
            }
        });

        input.addEventListener('blur', function() {
            const label = this.parentElement.querySelector('label');
            if (label) {
                label.classList.remove('label-focus');
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour charger l'image de la lightbox
    function loadLightboxImage(img) {
        if (img && !img.src) {
            img.src = img.getAttribute('data-src');
        }
    }

    // Ajouter un écouteur d'événement pour chaque lien de lightbox
    document.querySelectorAll('a[href^="#lightbox"]').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var lightbox = document.querySelector(link.getAttribute('href'));
            var img = lightbox.querySelector('img');

            loadLightboxImage(img); // Charger l'image

            lightbox.style.display = 'flex';
        });
    });

    // Fonction pour fermer la lightbox
    document.querySelectorAll('.lightbox .close').forEach(function(closeButton) {
        closeButton.addEventListener('click', function(event) {
            event.preventDefault();
            this.parentElement.style.display = 'none';
        });
    });
});