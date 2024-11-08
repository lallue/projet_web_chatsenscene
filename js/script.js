document.addEventListener("DOMContentLoaded", function () {
    let timer;
    let currentImageIndex = 0;
    let images = [];

    function loadImage() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../IMGViewer.xml', true);
        xhr.setRequestHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
        xhr.setRequestHeader('Pragma', 'no-cache');
        xhr.setRequestHeader('Expires', '0');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var xmlDoc = xhr.responseXML;
                var imageElements = xmlDoc.getElementsByTagName('image');

                images = Array.from(imageElements).map(img => img.textContent);

                if (images.length > 0) {
                    showImage(currentImageIndex);
                } else {
                    console.error("Aucune image trouvée dans IMGViewer.xml");
                }
            }
        };
        xhr.send();
    }

    function showImage(index) {
        if (images.length > 0) {
            var baseUrl = 'https://chatsenscene.alwaysdata.net/';
            var fullImageUrl = baseUrl + images[index];
            var resizedImageUrl = 'IMG/resizeImage.php?imageUrl=' + encodeURIComponent(fullImageUrl) + '&width=400&height=300';

            document.getElementById('dynamic-image').src = resizedImageUrl;
        }
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        showImage(currentImageIndex);
    }

    function previousImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        showImage(currentImageIndex);
    }

    loadImage(); // Charger l'image initiale

    // Timer pour le changement automatique d'image
    function resetTimer() {
        clearTimeout(timer);
        timer = setTimeout(loadImage, 10000);
    }


    document.addEventListener('mousemove', resetTimer);
    document.addEventListener('scroll', resetTimer);
    document.addEventListener('keydown', resetTimer);


    // Boutons précédent/suivant
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');

    if (prevButton) {
        prevButton.addEventListener('click', previousImage);
    }

    if (nextButton) {
        nextButton.addEventListener('click', nextImage);
    }

});