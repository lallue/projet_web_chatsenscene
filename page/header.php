<?php
    $config = include 'config.php';
    echo '<a href="../../index.php"><img src="../../../IMG/resizeImage.php?imageUrl=' . urlencode($config->url . '/IMGViewer/logoSite.png') . '&width=125&height=40" alt="Logo"></a>';
?>
<!-- Bouton Burger pour Mobile -->
<div class="burger" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
</div>
<!-- Menu de Navigation -->
<nav class="nav-center">
    <a href="../../index.php">Accueil</a>
    <a href="../../page/description.php">Description</a>
    <a href="../../page/contact.php">Contact</a>
</nav>